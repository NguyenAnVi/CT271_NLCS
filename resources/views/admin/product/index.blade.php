@extends('layouts.adminapp')

@section('content')

	@php 
	use App\Models\SaleOff;
	@endphp

<div class="uk-width-1-1 uk-padding ">
	<div class="uk-flex-between" uk-grid>
		<H3 class="uk-text-bold">Danh sách sản phẩm</H3>
		@include('partials/searchbar')
	</div>
	
	<div uk-grid class="uk-flex-between uk-margin-small">
		{{$products->links()}}
		<button form="create-form" class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small">Thêm sản phẩm mới &nbsp;&nbsp;&nbsp; <span uk-icon="plus"></span></button>
		<form hidden id="create-form" action="{{route('admin.product.create')}}" method="GET">@csrf</form>
	</div>
	
	<div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">
		<div class="uk-overflow-auto">
			{{-- table --}}
			<table class="uk-table uk-table-middle uk-table-divider">
				<thead>
					<tr>
						<th class="uk-table-shrink">ID</th>
						<th class="uk-width-small"></th>
						
						<th>Tên SP</th>
						<th class="uk-width-small" uk-tooltip="Giá bán (Chưa bao gồm khuyến mãi)">Gia</th>
						<th class="uk-width-small" uk-tooltip="Chương trình KM đang áp dụng">KM</th>
						<th class="uk-table-shrink">Sửa</th>
						<th class="uk-table-shrink">Xóa</th>
					</tr>
				</thead>
				<tbody uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;"> 
					@foreach ($products as $item)
					<tr>
						<td>{{$item->id}}</td>
						<td>
							@if(getImageAt($item->images, 0))
							<img class="uk-comment-avatar uk-object-cover" width="100"  style="aspect-ratio: 1 / 1;" src="{{getImageAt($item->images, 0)}}">
							@endif
						</td>
						<td>{{$item->name}}</td>
						<td>{{number_format($item->price, 0, ',', '.')}}đ</td>
						<form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.product.destroy',$item->id)}}" hidden>@csrf @method('delete')</form>
						<form id="item-{{$item->id}}-edit-form" method="GET" action="{{route('admin.product.edit',$item->id)}}" hidden></form>
						{{-- <form id="item-{{$item->id}}-images-form" method="GET" action="{{route('admin.product.showimages',['id' => $item->id])}}" hidden></form> --}}
						<?php 
							$item_saleoff = SaleOff::where('id', $item->saleoff_id)->first();
						?>
						<td uk-tooltip="@if(isset($item_saleoff->amount))Giảm @if($item_saleoff->amount != 0){{number_format($item_saleoff->amount, 0, ',', '.').'đ'}}@else{{$item_saleoff->percent.'%'}}@endif @endif">@if(isset($item_saleoff->name)){{$item_saleoff->name}}@endif</td>
						<td><button form="item-{{$item->id}}-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>
						<td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td>
					</tr>
					@endforeach
					
					
					
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script type="text/javascript">
	$('#search').on('keyup',function(){
		$value = $(this).val();
		$.ajax({
			type: 'get',
			url: '{{route('admin.product.search')}}',
			data: {
				'search': $value
			},
			success:function(data){
				$('tbody').html(data);
				$('ul.uk-pagination').hide();
			}
		});
	})
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

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
		$('#myImg').append('<li class="uk-active uk-width-1-4"><img class="uk-comment-avatar" src=' + e.target.result + ' width="100" height="67" ></li>');
	};  
</script>
@endsection