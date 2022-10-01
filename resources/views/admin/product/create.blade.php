@extends('layouts.adminapp')
@section('content')

<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{asset('froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<div class="uk-container uk-padding-small ">
    <div class="uk-cover-container">
        <div>
            <H3 class="uk-text-bold uk-width-expand">Thêm sản phẩm mới</H3>
        </div>
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
                <textarea name='detail' tabindex="2" id="froala-editor">{{old('detail')}}</textarea>
                @error('detail')
                <span class="uk-text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <script>new FroalaEditor('textarea#froala-editor')</script>

            <div class="uk-width-1-2@s">
                    <label class="uk-form-label" for="form-horizontal-select">
                        Chương trình khuyến mãi
                    </label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-horizontal-select" name="saleoff" onchange="changeFunc()">
                            @foreach($saleoffs as $saleoff)
                            <option value="{{$saleoff->id}}" @if(old('saleoff')==$saleoff->id)selected @endif>{{$saleoff->name}}</option>
                            @endforeach
                            <hr class="uk-divider-icon">
                            <option value="-1">{{__('Thêm CTKM mới')}}</option>
                        </select>
                        {{-- {{}} --}}
                    </div>
                    <script>
                        function changeFunc() {
                            var selectBox = document.getElementById("form-horizontal-select");
                            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                            if (selectedValue == -1) document.getElementById('new-saleoff').submit();
                        }
                    </script>
                
            </div>
            <div class="uk-width-1-2@s uk-grid-match">
                <div class="uk-width-1-1 uk-match" uk-form-custom>
                    <input name="images[]" type="file" accept="image/*" multiple>
                    <button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh</button>
                </div>
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="sets: true; finite: true; easing; velocity:3">
                    <ul id="myImg" class="uk-grid uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m">
                    </ul>
                </div>

            </div>

            <div class="uk-width-1-1@s">
                <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="create-form">Thêm</button>
            </div>
        </form>
        <form hidden id="new-saleoff" action="{{route('admin.saleoff.create')}}" method="get"></form>
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
        // $('#myImg').append('<li class="uk-active uk-width-1-4"><img class="uk-comment-avatar" src=' + e.target.result + ' width="100" height="67" ></li>');
        $('#myImg').append('<li><img src=' + e.target.result + ' width="400" height="600" alt=""></li>');
    };    
</script>
@endsection