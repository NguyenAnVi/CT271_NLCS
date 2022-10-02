@extends('layouts.adminapp')
@section('content')
<?php use App\Models\SaleOff;?>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<div class="uk-container uk-padding ">
    <div class="uk-flex-between" uk-grid>
        <H3 class="uk-text-bold">Danh sách sản phẩm</H3>
        {{-- Search field --}}
        <button class="uk-toggle uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small"><span uk-icon="search"></span></button>
        <div class="uk-drop" uk-drop="animation; animate-out:true;mode: click; pos: left-center; offset: 0">
            <form class="uk-search uk-search-default uk-width-1-1">
                <input id="search" class="uk-search-input" type="search" placeholder="Tìm kiếm...">
            </form>
        </div>
    </div>
    
    <div uk-grid class="uk-flex-between uk-margin-small">
        {{$products->links()}}
        <button form="create-form" class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small">Thêm sản phẩm mới &nbsp;&nbsp;&nbsp; <span uk-icon="plus"></span></button>
        <form hidden id="create-form" action="{{route('admin.product.create')}}" method="GET">@csrf</form>
    </div>
    

    <div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">
        <ul class="uk-slider-items uk-grid">
            <li class="uk-width-1-1">
                <div class="uk-cover-container">
                    {{-- table --}}
                    <table class="uk-table uk-table-middle uk-table-divider">
                        <thead>
                            <tr>
                                <th class="uk-table-shrink">ID</th>
                                <th class="uk-width-small"></th>
                                
                                <th>Tên SP</th>
                                <th class="uk-width-small" uk-tooltip="Giá bán (Chưa bao gồm khuyến mãi)">Gia</th>
                                <th class="uk-width-small" uk-tooltip="Chương trình KM đang áp dụng">KM</th>
                                <th class="uk-table-shrink">Sửa</th>
                                <th class="uk-table-shrink">Xóa</th>
                            </tr>
                        </thead>
                        <tbody uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;"> 
                            
                            @foreach ($products as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    @if(getImageAt($item->images, 0))
                                    <img class="uk-comment-avatar uk-object-cover" width="100"  style="aspect-ratio: 1 / 1;" src="{{getImageAt($item->images, 0)}}">
                                    @endif
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{number_format($item->price, 0, ',', '.')}}đ</td>
                                <form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.product.destroy',$item->id)}}" hidden>@csrf @method('delete')</form>
                                <form id="item-{{$item->id}}-edit-form" method="GET" action="{{route('admin.product.edit',$item->id)}}" hidden></form>
                                {{-- <form id="item-{{$item->id}}-images-form" method="GET" action="{{route('admin.product.showimages',['id' => $item->id])}}" hidden></form> --}}
                                <?php 
                                    $item_saleoff = SaleOff::where('id', $item->saleoff_id)->first();
                                ?>
                                <td uk-tooltip="Giảm @if($item_saleoff->amount != 0){{number_format($item_saleoff->amount, 0, ',', '.').'đ'}}@else{{$item_saleoff->percent.'%'}}@endif">{{$item_saleoff->name}}</td>
                                <td><button form="item-{{$item->id}}-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>
                                <td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td>
                            </tr>
                            @endforeach
                            
                            
                            
                        </tbody>
                    </table>
                    <script type="text/javascript">
                        $('#search').on('keyup',function(){
                            $value = $(this).val();
                            $.ajax({
                                type: 'get',
                                url: '{{route('admin.product.search')}}',
                                data: {
                                    'search': $value
                                },
                                success:function(data){
                                    $('tbody').html(data);
                                    $('ul.uk-pagination').hide();
                                }
                            });
                        })
                        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                    </script>
                </div>
            </li>
            <li id="add" class="uk-width-1-1">
                <div class="uk-cover-container">
                    {{-- adding form --}}
                    <form id="create-form" 
                            class="uk-grid-small uk-form" 
                            method="POST" enctype="multipart/form-data"
                            action="{{route('admin.product.store')}}" 
                            uk-grid>
                        @csrf
                        <div class="uk-width-1-2@s">
                            <input autofocus value="{{old('name')}}" tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" type="text" name="name" placeholder="Tên SP" required>
                            @error('name')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="uk-width-1-2@s">
                            {{-- <a class="uk-form-icon uk-form-icon-flip" href="#" uk-icon="icon: link"></a> --}}
                            <input tabindex="1" value="{{old('price')}}"
                                class="uk-input uk-width-1-1 uk-form-large @error('price') uk-form-danger @enderror" 
                                type="number" min="0"
                                name="price" placeholder="Giá bán (vnd)" required>
                            @error('price')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="uk-width-1-1@s">
                            <textarea 
                                tabindex="1" class="uk-textarea uk-width-1-1 uk-form-large @error('detail') uk-form-danger @enderror" 
                                name="detail" placeholder="Mo ta san pham">{{old('detail')}}</textarea>
                            @error('detail')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="uk-width-1-2@s">
                                <label class="uk-form-label" for="form-horizontal-select">
                                    Chương trình khuyến mãi
                                </label>
                                <div class="uk-form-controls">
                                    <select class="uk-select" id="form-horizontal-select" name="saleoff">
                                        @foreach($saleoffs as $saleoff)
                                        <option value="{{$saleoff->id}}" @if(old('saleoff')==$saleoff->id)selected @endif>{{$saleoff->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            
                        </div>
                        <div class="uk-width-1-2@s uk-grid-match">
                            <div class="uk-width-1-1 uk-match" uk-form-custom>
                                <input name="images[]" type="file" accept="image/*" multiple>
                                <button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh</button>
                            </div>
                            <ul id="myImg" class="uk-thumbnav" uk-margin uk-grid></ul>
                        </div>

                        <div class="uk-width-1-1@s">
                            <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="create-form">Thêm</button>
                        </div>
                    </form>
                    
                </div>
            </li>
        </ul>
    </div>
</div>
<script>
   $(function() {
        $(":file").change(function() {
            if (this.files && this.files[0]) {
                for (var i = 0; i < this.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[i]);
                }
            }
        });
    });

    function imageIsLoaded(e) {
        $('#myImg').append('<li class="uk-active uk-width-1-4"><img class="uk-comment-avatar" src=' + e.target.result + ' width="100" height="67" ></li>');
    };    
</script>
@endsection