@extends('layouts.adminapp')
@section('content')
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<div class="uk-container uk-padding-small ">
    <div class="uk-width-1-1 uk-padding">
        <h2 class="uk-text-center">Thay đổi thông tin chương trình khuyến mãi ({{$saleoff->name}})</h2>
        <p class="uk-text-center uk-text-italic">*Đánh dấu check <label><input class="uk-checkbox" type="checkbox" checked></label> vào những trường cần thay đổi</p>
        
        <form id="edit-form" class="uk-grid-small uk-form uk-child-width-1-1" method="POST" 
            enctype="multipart/form-data"
            action="{{ route('admin.saleoff.update', ['saleoff' => $saleoff]) }}" 
            uk-grid="">
            @csrf
            <div class="uk-form" uk-grid>
                <div class="uk-width-expand uk-grid-match" uk-grid>
                    <div class="uk-width-auto@s uk-width-expand@m uk-text-right">
                        <label class="uk-form-large ">
                            <input name="name_check" class="uk-checkbox" type="checkbox" checked>
                        </label>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-4@m">
                        <span class="uk-text-bold uk-form-large">Tên CTKM: </span>
                    </div>
                    <div class="uk-width-1-1@s uk-width-2-3@m">
                        <input value="@if(old('name') !=NULL){{old('name')}}@else{{$saleoff->name}}@endif" autofocus tabindex="1" 
                        class="uk-input uk-form-large @error('name') uk-form-danger @enderror" 
                        type="text" name="name" placeholder="CTKM">
                        @error('name')
                        <span class="uk-text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>

            <div class="uk-form" uk-grid>
                <div class="uk-width-expand uk-grid-match" uk-grid>
                    <div class="uk-width-auto@s uk-width-expand@m uk-text-right">
                        <label class="uk-form-large ">
                            <input name="price_check" class="uk-checkbox" type="checkbox" checked>
                        </label>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-4@m">
                        <span class="uk-text-bold uk-form-large">Giá KM: </span>
                    </div>
                    <div class="uk-width-1-1@s uk-width-2-3@m">
                        <div class="uk-margin uk-grid-large uk-child-width-auto uk-grid">
                            <label><input class="uk-radio" type="radio" @if(old('price_amount') || $saleoff->amount!=0){{__('checked')}}@endif name="price_check" value="1">
                                Giảm giá theo tiền mặt (VNĐ):
                            </label>
                        </div>
                        <div class="uk-width-1-1"> 
                            <input value="@if(old('price_amount')!=NULL){{old('price_amount')}}@else{{$saleoff->amount}}@endif" tabindex="1" class="uk-input uk-width-expand uk-form-large @error('price_amount') uk-form-danger @enderror" 
                            type="number" min="0" name="price_amount" placeholder="Giá KM (vnd)">
                            @error('price_amount')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                            <label><input class="uk-radio" type="radio" name="price_check" @if(old('price_percent') || $saleoff->percent!=0){{__('checked')}}@endif value="0">
                                Giảm giá theo phần trăm (%):
                            </label>
                        </div>
                        <div class="uk-width-1-1">
                            <input value="@if(old('price_percent')!=NULL){{old('price_percent')}}@else{{$saleoff->percent}}@endif" tabindex="1" class="uk-input  uk-form-large @error('price_percent') uk-form-danger @enderror" type="number" min="0" max="100"name="price_percent" placeholder="Giá KM theo phần trăm">
                            @error('price_percent')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                        </div>

                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="uk-form" uk-grid>
                <div class="uk-width-expand uk-grid-match" uk-grid>
                    <div class="uk-width-auto@s uk-width-expand@m uk-text-right">
                        <label class="uk-form-large "><input name="time_check" class="uk-checkbox" type="checkbox"></label>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-4@m">
                        <span class="uk-text-bold uk-form-large">Thời gian diễn ra: </span>
                    </div>
                    <div class="uk-width-1-1@s uk-width-2-3@m">
                        <div class="uk-width-1-2@s">
                            <label for="saleoff_start">
                                Thời điểm bắt đầu:<input value="@if(old('saleoff_starttime')){{old('saleoff_starttime')}}@else{{$saleoff->starttime}}@endif" tabindex="1" type="datetime-local" class="uk-input uk-width-1-1 uk-form-large @error('saleoff_starttime') uk-form-danger @enderror" name="saleoff_starttime">
                            </label>
                            @error('saleoff_starttime')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                        </div>
        
                        <div class="uk-width-1-2@s">
                            <label for="saleoff_endtime">
                                Thời điểm kết thúc:<input value="@if(old('saleoff_endtime')){{old('saleoff_endtime')}}@else{{$saleoff->endtime}}@endif" tabindex="1" type="datetime-local" name="saleoff_endtime" class="uk-input uk-width-1-1 uk-form-large @error('saleoff_endtime') uk-form-danger @enderror">
                            </label>
                            @error('saleoff_endtime')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>

            <div class="uk-form" uk-grid>
                <div class="uk-width-expand uk-grid-match" uk-grid>
                    <div class="uk-width-auto@s uk-width-expand@m uk-text-right">
                        <label class="uk-form-large ">
                            <input name="image_check" class="uk-checkbox" type="checkbox" checked>
                        </label>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-4@m">
                        <span class="uk-text-bold uk-form-large">Ảnh banner: </span>
                    </div>
                    <div class="uk-width-1-1@s uk-width-2-3@m">
                        <div class="uk-width-1-1" uk-form-custom>
                            <input id="file-input" type="file" name="banner" accept="image/*">
                            <button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh banner</button>
                        </div>
                        @error('banner')<span class="uk-text-danger"><strong>{{ $message }}</strong></span>@enderror
                        <div id="myImg" class="uk-width-1-1@s uk-text-center" uk-margin></div>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-1@s">
                
            </div>
            
            <div class="uk-width-1-1@s  uk-text-center">
                <button tabindex="1" 
                    class="uk-button uk-button-primary uk-button-large uk-width-1-4" 
                    type="submit" form="edit-form" >Thay đổi</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
         $("#file-input").change(function() {
             if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
             }
         });
     });
     function imageIsLoaded(e) {
         document.getElementById("myImg").innerHTML = "";
         $('#myImg').append('<img src="' + e.target.result + '"">');
     };     
 </script>
@endsection