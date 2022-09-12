@extends('layouts.adminapp')
@section('content')
<div class="uk-container uk-padding-small ">
    <div class="uk-width-1-1 uk-padding">
        <h2 class="uk-text-center">Thay đổi thông tin người dùng ({{$admin->id}})</h2>
        <p class="uk-text-center uk-text-italic">*Đánh dấu check <label><input class="uk-checkbox" type="checkbox" checked></label> vào những trường cần thay đổi</p>
        <form id="edit-form" 
                class="uk-grid-small uk-form uk-child-width-1-1" 
                method="POST" 
                action="{{ route('admin.hr.update', ['id' => $admin->id]) }}" 
                uk-grid="">
            @csrf
            <div class="uk-form" uk-grid>
                <div class="uk-width-expand uk-grid-match" uk-grid>
                    <div class="uk-width-auto@s uk-width-expand@m uk-text-right">
                        <label class="uk-form-large ">
                            <input name="name_check" class="uk-checkbox" type="checkbox" onchange="inputToggle()">
                        </label>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-4@m">
                        <span class="uk-text-bold uk-form-large">Họ và Tên: </span>
                    </div>
                    <div class="uk-width-1-1@s uk-width-2-3@m">
                        <input value="@if(old('name')!=NULL){{old('name')}}@else{{$admin->name}}@endif" autofocus tabindex="1" 
                        class="uk-input uk-form-large @error('name') uk-form-danger @enderror" 
                        type="text" name="name" placeholder="Họ và tên" disabled>
                        @error('name')
                        <span class="uk-text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="uk-form" uk-grid>
                <div class="uk-width-expand uk-grid-match" uk-grid>
                    <div class="uk-width-auto@s uk-width-expand@m uk-text-right">
                        <label class="uk-form-large ">
                            <input name="phone_check" class="uk-checkbox" type="checkbox" onchange="inputToggle()">
                        </label>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-4@m">
                        <span class="uk-text-bold uk-form-large">Điện thoại: </span>
                    </div>
                    <div class="uk-width-1-1@s uk-width-2-3@m">
                        <input value="@if(old('phone')!=NULL){{old('phone')}}@else{{$admin->phone}}@endif" autofocus tabindex="1" 
                        class="uk-input uk-form-large @error('phone') uk-form-danger @enderror" 
                        type="text" name="phone" placeholder="Điện thoại" disabled>
                        @error('phone')
                        <span class="uk-text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="uk-form" uk-grid>
                <div class="uk-width-expand uk-grid-match" uk-grid>
                    <div class="uk-width-auto@s uk-width-expand@m uk-text-right">
                        <label class="uk-form-large ">
                            <input name="password_check" class="uk-checkbox" type="checkbox" onchange="inputToggle()">
                        </label>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-4@m">
                        <span class="uk-text-bold uk-form-large">Mật khẩu: </span>
                    </div>
                    <div class="uk-width-1-1@s uk-width-2-3@m">
                        <input value="" autofocus tabindex="1" 
                        class="uk-input uk-form-large @error('password') uk-form-danger @enderror" 
                        type="text" name="password" placeholder="Mật khẩu mới" disabled>
                        @error('password')
                        <span class="uk-text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s  uk-text-center">
                <button tabindex="1" 
                    class="uk-button uk-button-primary uk-button-large uk-width-1-4" 
                    type="submit" form="edit-form" disabled>Thay đổi</button>
            </div>
        </form>
        <script>
            function checkSubmitable(){

            }
            function inputToggle(){

            }
        </script>
    </div>
</div>
@endsection