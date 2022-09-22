@extends('layouts.adminapp')
@section('content')
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<div class="uk-container uk-padding-small ">
    <div>
        <ul class="uk-child-width-expand" uk-tab>
            <li onclick="UIkit.slider('#slcontent').show('0');" class="uk-active"><a href=""><h3 class="uk-text-bold">Danh sách Sản phẩm</h3></a></li>
            <li onclick="UIkit.slider('#slcontent').show('1');" class="" ><a href="#"><h3 class="uk-text-bold">Thêm SP mới</h3></a></li>
        </ul>
    </div>
    <div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">
        <ul class="uk-slider-items uk-grid uk-grid-match">
            <li class="uk-width-1-1">
                <div class="uk-cover-container">
                    {{-- table --}}
                    <table class="uk-table uk-table-middle uk-table-divider">
                        <thead>
                            <tr>
                                <th class="uk-width-small">ID</th>
                                <th>Tên</th>
                                <th class="uk-width-small">ChiTiet</th>
                                <th class="uk-width-small">Gia</th>
                                <th class="uk-width-small">SaleOff</th>
                                <th class="uk-width-small">HinhAnh</th>
                                <th class="uk-table-shrink">Sửa</th>
                                <th class="uk-table-shrink">Xóa</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(isset($admins))
                            @foreach ($products as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->detail}}</td>
                                <td>{{$item->price}}</td>
                                <form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.product.destroy',['id' => $item->id])}}" hidden>@csrf @method('delete')</form>
                                <form id="item-{{$item->id}}-edit-form" method="GET" action="{{route('admin.product.edit',['id' => $item->id])}}" hidden></form>
                                <form id="item-{{$item->id}}-images-form" method="GET" action="{{route('admin.product.showimages',['id' => $item->id])}}" hidden></form>

                                <td><button form="item-{{$item->id}}-images-form" class="uk-button-primary" type="submit"><span uk-icon="pencil"></span></button></td>
                                <td><button form="item-{{$item->id}}-edit-form" class="uk-button-primary" type="submit"><span uk-icon="pencil"></span></button></td>
                                <td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger" type="submit"><span uk-icon="close"></span></button></td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </li>
            <li id="add" class="uk-width-1-1">
                <div class="uk-cover-container">
                    {{-- adding form --}}
                    <form id="register-form" 
                          class="uk-grid-small uk-form" 
                          method="POST" 
                          action="{{ route('admin.product.create') }}" 
                          uk-grid="">
                        @csrf
                        <div class="uk-width-1-2@s">
                            <input autofocus tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" type="text" name="name" placeholder="Tên SP" required>
                            @error('name')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="uk-width-1-2@s">
                            {{-- <a class="uk-form-icon uk-form-icon-flip" href="#" uk-icon="icon: link"></a> --}}
                            <input 
                                tabindex="1" 
                                class="uk-input uk-width-1-1 uk-form-large @error('price') uk-form-danger @enderror" 
                                type="number" 
                                name="phone" 
                                placeholder="Giá bán (vnd)" 
                                required>
                            @error('price')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="uk-width-1-1@s">
                            <textarea 
                                tabindex="1" class="uk-textarea uk-width-1-1 uk-form-large @error('detail') uk-form-danger @enderror" 
                                name="detail" placeholder="Mo ta san pham"></textarea>
                            @error('detail')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
    
                        <div class="uk-width-1-2@s uk-padding">
                            <label for="saleoff_check" class="uk-margin">
                                <input tabindex="1" type="checkbox" name="saleoff_check" 
                                class="uk-checkbox @error('password_confirmation') uk-form-danger @enderror" 
                                placeholder="Exp" required>
                                "SaleOff"
                            </label>
                            <div>
                                <label class="uk-form-label" for="form-horizontal-select">Select</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select" id="form-horizontal-select">
                                        @foreach($saleoffs as $saleoff)
                                            <option>{{$saleoff->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="uk-width-1-2@s">
                            <div class="uk-width-1-1 uk-match" uk-form-custom>
                                <input type="file" multiple>
                                <button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh</button>
                            </div>
                            <ul id="myImg" class="uk-thumbnav" uk-margin></ul>
                        </div>

                        <div class="uk-width-1-1@s">
                            <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="register-form">Thêm</button>
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
        $('#myImg').append('<li class="uk-active"><img src=' + e.target.result + ' width="100" height="67" ></li>');
    };    
</script>
@endsection