@extends('layouts.adminapp')
@section('content')
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<div class="uk-container uk-padding-small ">
    <div>
        <ul class="uk-child-width-expand" uk-tab>
            <li onclick="UIkit.slider('#slcontent').show('0');" class="uk-active"><a href="">
                <h3 class="uk-text-bold">Các chương trình KM</h3>
            </a></li>
            <li onclick="UIkit.slider('#slcontent').show('1');" class="" ><a href="#">
                <h3 class="uk-text-bold">Thêm CTKM</h3>
            </a></li>
        </ul>
    </div>
    <div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">
        <ul class="uk-slider-items uk-grid uk-grid-match">
            <li id="list-page" class="uk-width-1-1">
                <div class="uk-cover-container">
                @if(isset($saleoffs))
                    {{-- table --}}
                    <table class="uk-table uk-table-middle uk-table-divider">
                        <thead>
                            <tr>
                                <th class="uk-width-small">ID</th>
                                <th class="">Tên CTKM</th>
                                {{-- <th class="uk-width-small">ChiTiet</th> --}}
                                <th class="uk-width-small">Giá giảm</th>
                                {{-- <th class="uk-width-small">SaleOff</th> --}}
                                {{-- <th class="uk-width-small">HinhAnh</th> --}}
                                <th class="">Ngày bắt đầu</th>
                                <th class="">Ngày hết hạn</th>
                                <th class="uk-table-shrink">Sửa</th>
                                <th class="uk-table-shrink">Xóa</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($saleoffs as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                {{-- <td>{{$item->detail}}</td> --}}
                                @if($item->amount>$item->percent)
                                <td>{{$item->amount}} vnđ</td>
                                @else
                                <td>{{$item->percent}}%</td>
                                @endif
                                <td>{{$item->starttime}}</td>
                                <td>{{$item->endtime}}</td>
                                <form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.saleoff.destroy', $item->id)}}" hidden>@csrf @method('delete')</form>
                                <form id="item-{{$item->id}}-edit-form" method="GET" action="{{route('admin.saleoff.edit', $item->id)}}" hidden></form>
                                {{-- <form id="item-{{$item->id}}-images-form" method="GET" action="{{route('admin.saleoff.showimages',['id' => $item->id])}}" hidden></form> --}}

                                {{-- <td><button form="item-{{$item->id}}-images-form" class="uk-button-primary" type="submit"><span uk-icon="pencil"></span></button></td> --}}
                                <td><button form="item-{{$item->id}}-edit-form" class="uk-button-primary" type="submit"><span uk-icon="pencil"></span></button></td>
                                <td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger" type="submit"><span uk-icon="close"></span></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$saleoffs->links()}}
                @else
                    <div class="uk-position-center">
                        Hiện chưa có sản phẩm nào
                    </div>
                @endif
                </div>
            </li>
            <li id="add-page" class="uk-width-1-1">
                <div class="uk-cover-container">
                    {{-- adding form --}}
                    <form id="main-form" 
                            class="uk-grid-small uk-form" 
                            method="POST" enctype="multipart/form-data"
                            action="{{ route('admin.saleoff.store') }}" 
                            uk-grid="">
                        @csrf
            
                        {{-- name --}}
                        <div class="uk-width-1-1@s">
                            <input autofocus tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" 
                                type="text" name="name" placeholder="Tên CTKM" required>
                            @error('name')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        {{-- price_check(value=1) => price_amount --}}
                        <div class="uk-width-1-1@s">
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label>
                                    <input class="uk-radio" type="radio" checked name="price_check" value="1">
                                    Giảm giá theo tiền mặt (VNĐ):
                                </label>
                            </div>
                            <div class="uk-width-1-1"> 
                                <input tabindex="1" class="uk-input uk-width-expand uk-form-large @error('price_amount') uk-form-danger @enderror" 
                                type="number" min="0" name="price_amount" placeholder="Giá KM (vnd)">
                                @error('price_amount')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
            
                        {{-- price_check(value=0) => price_percent --}}
                        <div class="uk-width-1-1@s">
                            <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                <label>
                                    <input class="uk-radio" type="radio" name="price_check" value="0">
                                    Giảm giá theo phần trăm (%):
                                </label>
                            </div>
                            <div class="uk-width-1-1">
                                <input tabindex="1" class="uk-input  uk-form-large @error('price_percent') uk-form-danger @enderror" type="number" min="0" max="100"name="price_percent" placeholder="Giá KM theo phần trăm">
                                @error('price_percent')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
            
                        <div class="uk-width-1-1@s uk-child-width-expand uk-padding-remove-right" uk-grid>                           
                            <div class="uk-width-1-2@s">
                                <label for="saleoff_start">Thời điểm bắt đầu:
                                    <input tabindex="1" type="datetime-local" class="uk-input uk-width-1-1 uk-form-large @error('saleoff_starttime') uk-form-danger @enderror" name="saleoff_starttime">
                                </label>
                                @error('saleoff_starttime')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                            </div>
            
                            <div class="uk-width-1-2@s">
                                <label for="saleoff_endtime">Thời điểm kết thúc:
                                    <input tabindex="1" type="datetime-local" name="saleoff_endtime" class="uk-input uk-width-1-1 uk-form-large @error('saleoff_endtime') uk-form-danger @enderror">
                                </label>
                                @error('saleoff_endtime')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            
                        </div>
                        
                        <div class="uk-width-1-1@s">
                            <div class="uk-width-1-1 uk-match" uk-form-custom>
                                <input type="file" name="banner" accept="image/*">
                                <button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh banner</button>
                                @error('banner')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div id="myImg" class="uk-width-1-1@s uk-text-center" uk-margin></div>
                        </div>
            
                        <div class="uk-width-1-1@s">
                            <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="main-form">Thêm</button>
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
                // for (var i = 0; i < this.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                // }
            }
        });
    });
    function imageIsLoaded(e) {
        document.getElementById("myImg").innerHTML = "";
        $('#myImg').append('<img src="' + e.target.result + '"">');
    };    
</script>
@endsection