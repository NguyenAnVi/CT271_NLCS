<div uk-grid class="uk-flex-between uk-margin-small">
	{!!$products->links()!!}
	<button form="create-form" class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small">Thêm sản phẩm mới &nbsp;&nbsp;&nbsp; <span uk-icon="plus"></span></button>
	<form hidden id="create-form" action="{{route('admin.product.create')}}" method="GET">@csrf</form>
</div>
<div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">
	<div class="uk-overflow-auto">
		<table class="uk-table uk-table-middle uk-table-divider">
			<thead>
				<tr>
				<th class="uk-table-shrink">ID</th>
				<th class="uk-width-small"></th>
				<th>Tên SP</th>
				<th class="uk-width-small" uk-tooltip="Giá bán (Chưa bao gồm khuyến mãi)">Giá</th>
				<th class="uk-width-small" uk-tooltip="Chương trình KM đang áp dụng">KM</th>
				<th class="uk-table-shrink">Sửa</th>
				<th class="uk-table-shrink">Xóa</th>
				</tr>
			</thead>
			<tbody uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;">
				@foreach ($products as $item)
					@include('partials/productTableRow', ['item'=> $item])
				@endforeach
			</tbody>
		</table>
	</div>
</div>
	