<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
<form id="edit-form" uk-grid
		class="uk-grid-small uk-form uk-child-width-1-1" 
		method="POST"  enctype="multipart/form-data"
		action="{{route('admin.product.update', $product->id)}}">
	@csrf
	@method('put')
	<div class="uk-form" uk-grid>
		<div class="uk-width-expand uk-grid-match" uk-grid>
			<div class="uk-width-1-1@s uk-width-1-4@l">
				<label class="uk-form-large ">
					<input id="name_check" name="name_check" class="uk-checkbox" type="checkbox">
					<label for="name_check" class="uk-text-bold uk-form-large">Tên SP: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-3-4@l">
				<input value="@if(old('name')!=NULL){{old('name')}}@else{{$product->name}}@endif" tabindex="1" 
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
			<div class="uk-width-1-1@s uk-width-1-4@l">
				<label class="uk-form-large ">
					<input id="price_check" name="price_check" class="uk-checkbox" type="checkbox">
					<label for="price_check" class="uk-text-bold uk-form-large">Giá bán: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-3-4@l">
				<input value="@if(old('price')!=NULL){{old('price')}}@else{{$product->price}}@endif" tabindex="1" 
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
			<div class="uk-width-1-1@s uk-width-1-4@l">
				<label class="uk-form-large ">
					<input id="detail_check" name="detail_check" class="uk-checkbox" type="checkbox">
					<label for="detail_check" class="uk-text-bold uk-form-large">Chi tiết: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-3-4@l">
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
			<div class="uk-width-1-1@s uk-width-1-4@l">
				<label class="uk-form-large ">
					<input id="saleoff_check" name="saleoff_check" class="uk-checkbox" type="checkbox">
					<label for="saleoff_check" class="uk-text-bold uk-form-large">CTKM: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-3-4@l">
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
			<div class="uk-width-1-1@s uk-width-1-4@l">
				<label class="uk-form-large ">
					<input id="images_check" name="images_check" class="uk-checkbox" type="checkbox">
					<label for="images_check" class="uk-text-bold uk-form-large">Hình ảnh: </label>
				</label>
			</div>
			<div class="uk-width-1-1@s uk-width-3-4@l">
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

<script type="text/javascript" src="{{asset('froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script>

	$(document).ready(function(){
		FroalaEditor('textarea#froala-editor');
		initialize();
	});

	function initialize(){
		$('input').on('change', function(e){
			let name = $(this).attr('name');
			if(name == 'images[]')
				name = 'images_check';
			else name += '_check';
			$('input[name='+name+']').attr('checked','checked');
			});
		$('select').on('click', function(){
			let name = $(this).attr('name')+'_check';
			$('input[name='+name+']').attr('checked','checked');
			});

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
	}
		
</script>