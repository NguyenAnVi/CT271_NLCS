@extends('admin.layouts.app')

@section('css')
<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="uk-container">
    <div class="uk-cover-container uk-padding">
        <div>
            <H3 class="uk-text-bold uk-text-center uk-width-expand">Thêm danh mục mới</H3>
            <hr>
        </div>

        {{-- adding form --}}
        <form id="create-form" uk-grid
                class="uk-grid-small uk-form" 
                method="POST"
                action="{{route('admin.category.store')}}">
            @csrf
            <div class="uk-width-1-1@s"> {{-- Ten danh muc --}}
                <input autofocus value="" tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" 
                    type="text" name="name" placeholder="Tên danh mục" required>
                @error('name')
                <span class="uk-text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="uk-width-1-1@s"> {{-- Danh muc cha --}}
                <label class="uk-form-label" for="form-horizontal-select">Danh Mục</label>
                <div class="uk-form-controls">
                    <select class="uk-select" id="form-horizontal-select" name="parent_id">
                        <option value="0"> * </option>
                        @foreach($categories as $category)
                        <option @if(old('parent_id')==$category->id)selected @endif value="{{(int) $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>

            <div class="uk-width-1-1@s"> {{--Mô Tả Chi Tiết--}}
                <textarea name='detail' tabindex="2" id="froala-editor">{{old('detail')}}</textarea>
                @error('detail')
                <span class="uk-text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="uk-width-1-2@s">
                <label class="uk-form-label" for="form-horizontal-select">Kích Hoạt</label>
                <label>
                    <input class="uk-radio" type="radio" checked name="status" value="1">
                    Có:
                </label>
                <label>
                    <input class="uk-radio" type="radio" name="status" value="0">
                    Không:
                </label>
            </div>

            <div class="uk-width-1-1@s">
                <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="create-form">Thêm</button>
            </div>
        </form>
        <form hidden id="new-saleoff" action="{{route('admin.category.create')}}" method="get"></form>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{asset('froala-editor/js/plugins/image.min.js')}}"></script>
<script type="text/javascript" src="{{asset('froala-editor/js/plugins/file.min.js')}}"></script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>

@endsection



        