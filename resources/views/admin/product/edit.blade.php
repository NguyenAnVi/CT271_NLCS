@extends('layouts.adminapp')

@section('css')
<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
	<div class="uk-width-1-1 uk-padding">
		<h3 class="uk-text-bold uk-text-center">Thay đổi thông tin sản phẩm ({{$product->id}})</h3>
		<HR>
		<form id="edit-form" uk-grid
				class="uk-grid-small uk-form uk-child-width-1-1" 
				method="POST" 
				action="{{route('admin.product.update', $product->id)}}">
			@csrf
			@method('put')
			<div class="uk-form" uk-grid>
				<div class="uk-width-expand uk-grid-match" uk-grid>
					<div class="uk-width-auto@s uk-width-expand@m uk-text-right">
						
					</div>
					<div class="uk-width-expand@s uk-width-1-4@m">
					</div>
					<div class="uk-width-1-1@s uk-width-2-3@m">
						<p class="uk-text-italic">*Đánh dấu check <label><input class="uk-checkbox" type="checkbox" checked></label> vào những trường cần thay đổi</p>
					</div>
				</div>
			</div>
			<div class="uk-form" uk-grid>
				<div class="uk-width-expand uk-grid-match" uk-grid>
					<div class="uk-width-auto@s uk-width-expand@m uk-text-right">
						<label class="uk-form-large ">
							<input name="name_check" class="uk-checkbox" type="checkbox">
						</label>
					</div>
					<div class="uk-width-expand@s uk-width-1-4@m">
						<span class="uk-text-bold uk-form-large">Tên SP: </span>
					</div>
					<div class="uk-width-1-1@s uk-width-2-3@m">
						<input value="@if(old('name')!=NULL){{old('name')}}@else{{$product->name}}@endif" autofocus tabindex="1" 
						class="uk-input uk-form-large @error('name') uk-form-danger @enderror" 
						type="text" name="name" placeholder="Họ và tên">
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
							<input name="price_check" class="uk-checkbox" type="checkbox">
						</label>
					</div>
					<div class="uk-width-expand@s uk-width-1-4@m">
						<span class="uk-text-bold uk-form-large">Giá bán: </span>
					</div>
					<div class="uk-width-1-1@s uk-width-2-3@m">
						<input value="@if(old('price')!=NULL){{old('price')}}@else{{$product->price}}@endif" autofocus tabindex="1" 
						class="uk-input uk-form-large @error('price') uk-form-danger @enderror" 
						type="text" name="price" placeholder="Giá bán" >
						@error('price')
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
							<input name="detail_check" class="uk-checkbox" type="checkbox">
						</label>
					</div>
					<div class="uk-width-expand@s uk-width-1-4@m">
						<span class="uk-text-bold uk-form-large">Chi tiết: </span>
					</div>
					<div class="uk-width-1-1@s uk-width-2-3@m">
						<textarea name='detail' tabindex="2" id="froala-editor">@if(old('detail')!=NULL){{old('detail')}}@else{{$product->detail}}@endif</textarea>
						@error('detail')
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
							<input name="saleoff_check" class="uk-checkbox" type="checkbox">
						</label>
					</div>
					<div class="uk-width-expand@s uk-width-1-4@m">
						<span class="uk-text-bold uk-form-large">CTKM: </span>
					</div>
					<div class="uk-width-1-1@s uk-width-2-3@m">
						<select class="uk-select" id="saleoff-select" name="saleoff" onchange="changeFunc()">
							@foreach($saleoffs as $saleoff)
							<option value="{{$saleoff->id}}" @if((old('saleoff')==$saleoff->id)||($product->saleoff_id==$saleoff->id))selected @endif>{{$saleoff->name}}</option>
							@endforeach
							<hr class="uk-divider-icon">
							<option value="-1">{{__('Thêm CTKM mới')}}</option>
						</select>
					</div>
				</div>
			</div>

			<div class="uk-form" uk-grid>
				<div class="uk-width-expand uk-grid-match" uk-grid>
					<div class="uk-width-auto@s uk-width-expand@m uk-text-right">
						<label class="uk-form-large ">
							<input name="images_check" class="uk-checkbox" type="checkbox">
						</label>
					</div>
					<div class="uk-width-expand@s uk-width-1-4@m">
						<span class="uk-text-bold uk-form-large">Hình ảnh: </span>
					</div>
					<div class="uk-width-1-1@s uk-width-2-3@m">
						<div class="uk-width-1-1 uk-match" uk-form-custom>
							<input name="images[]" type="file" accept="image/*" multiple>
							<button class="uk-button uk-button-default uk-margin uk-width-1-1" type="button" tabindex="-1">Hình ảnh</button>
						</div>
						<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="sets: true; finite: true; easing; velocity:3">
							<ul id="myImg" class="uk-grid uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m">
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="uk-width-1-1@s  uk-text-center">
				<button tabindex="1" 
					class="uk-button uk-button-primary uk-button-large uk-width-1-4" 
					type="submit" form="edit-form" >Thay đổi</button>
			</div>
		</form>
		<form hidden id="new-saleoff" action="{{route('admin.saleoff.create')}}" method="get"></form>
	</div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script> FroalaEditor('textarea#froala-editor')</script>
<script>
	function changeFunc() {
		var selectBox = document.getElementById("saleoff-select");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		if (selectedValue == -1) document.getElementById('new-saleoff').submit();
	}
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