@extends('layouts.adminapp')

@section('content')
<div class="uk-container uk-padding-small ">
	<div class="uk-cover-container">
		<div>
			<H3 class="uk-text-bold uk-width-expand">Thêm nhân viên mới</H3>
		</div>
		{{-- adding form --}}
		<form id="register-form" uk-grid
				class="uk-grid-small uk-form" 
				method="POST" 
				action="{{ route('admin.hr.store') }}">
			@csrf
			<div class="uk-width-1-2@s">
				<input autofocus tabindex="1"  value="{{old('name')}}"
				class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" 
				type="text" name="name" placeholder="Họ và tên" required>
				@error('name')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>

			<div class="uk-width-1-2@s">
				<input  value="{{old('phone')}}" tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('phone') uk-form-danger @enderror" type="phone" name="phone" placeholder="Điện thoại" required>
				@error('phone')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
			
			<div class="uk-width-1-2@s">
				<input tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('password') uk-form-danger @enderror" type="password" name="password" placeholder="Nhập mật khẩu mới" required>
				@error('password')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>

			<div class="uk-width-1-2@s">
				<input tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('password_confirmation') uk-form-danger @enderror" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
				@error('password_confirmation')
				<span class="uk-text-danger">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>

			<div class="uk-width-1-1@s">
				<button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="register-form">Thêm</button>
			</div>
		</form>
		
	</div>
</div>
@endsection