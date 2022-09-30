@extends('layouts.adminapp')
@section('content')
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<div class="uk-container uk-padding-small ">
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
                <ul id="myImg" class="uk-thumbnav" uk-margin></ul>
            </div>

            <div class="uk-width-1-1@s">
                <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="create-form">Thêm</button>
            </div>
        </form>
        
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