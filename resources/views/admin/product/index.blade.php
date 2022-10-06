@extends('layouts.adminapp')

@section('content')

<div class="uk-width-1-1 uk-padding ">
	<div class="uk-flex-between" uk-grid>
		<div class="uk-visible@m"></div>
		<H3 class="uk-text-bold">Danh sách sản phẩm</H3>
		@include('partials/searchbar')
	</div>
	<div id="ajx">
		@include('partials/productTable', ['products'=>$products])
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
			url: '{{route("admin.product.search")}}',
			data: {
				'search': $value
			},
			success:function(obj, textstatus){
				// $('#ajx').html("");
				$('#ajx').html(productTable(JSON.parse(obj)));
				// $('#ajx').html(obj);
			}
		});
	});
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

	function productTable(products){
		let o = '';
		o = '<div uk-grid class="uk-flex-between uk-margin-small">';
		// o += callPaginator($json);
		o += '<button form="create-form" class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small">Thêm sản phẩm mới &nbsp;&nbsp;&nbsp; <span uk-icon="plus"></span></button>';
		o += '<form hidden id="create-form" action="{{route("admin.product.create")}}" method="GET"><input type="hidden" name="_token" value="{{csrf_token()}}" /></form>';
		o += '</div>';
		o += '<div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">';
		o += '<div class="uk-overflow-auto">';
		o += '<table class="uk-table uk-table-middle uk-table-divider">';
		o += '<thead>';
		o += '<tr>';
		o += '<th class="uk-table-shrink">ID</th>';
		o += '<th class="uk-width-small"></th>';
		o += '<th>Tên SP</th>';
		o += '<th class="uk-width-small" uk-tooltip="Giá bán (Chưa bao gồm khuyến mãi)">Gia</th>';
		// o += '<th class="uk-width-small" uk-tooltip="Chương trình KM đang áp dụng">KM</th>';
		o += '<th class="uk-table-shrink">Sửa</th>';
		o += '<th class="uk-table-shrink">Xóa</th>';
		o += '</tr>';
		o += '</thead>';
		o += '<tbody uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;">';
			products.forEach(function(item) {
				o += productTableRow(item);
			});
		o += '</tbody>';
		o += '</table>';
		o += '</div>';
		o += '</div>';
		return o;
	}

	function productTableRow(item){
    	o =  '<tr>';
		o += '<td>' +item.id +'</td>';
		// o +='<td>'+item.images+'</td>';
		o += getCollection(item.images);
		o += '<td>' + item.name + '</td>';
		o += '<td>{{number_format((int)'+item.price+', 0, ',', '.')}}đ</td>';
		// o += '<form id="item-'+item.id+'-destroy-form" method="POST" action="'+getRoute('admin.product.destroy', item.id)+'" hidden><input type="hidden" name="_token" value="{{csrf_token()}}"/> <input type="hidden" name="_method" value="delete"></form>';
		o += '<form id="item-'+item.id+'-edit-form" method="GET" action="http://localhost:8000/admin/product/'+item.id+'/edit" hidden></form>';
		o += '<td><button form="item-'+item.id+'-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>';
		o += '<td><button form="item-'+item.id+'-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td>';
		o += '</tr>';

		return o;
	}

	function getCollection(urls){
		o  = '<td><div style="width:10rem; height:5rem;overflow: hidden" uk-slider="center:true; finite :true; ">';
		o += '<ul class="uk-grid uk-slider-items uk-child-width-1-1">';
		if(urls){
			arr = JSON.parse(urls)
            // $js = json_decode(str_replace('\\','',$array));
			arr.forEach(function(item) {
				o += '<li><img style="object-fit: cover;width:10rem; height:5rem;" src="' + item + '"></li>';
			});
        }
		o += '</ul></div></td>';
        return o;
	}

	function imageIsLoaded(e) {
		$('#myImg').append('<li class="uk-active uk-width-1-4"><img class="uk-comment-avatar" src=' + e.target.result + ' width="100" height="67" ></li>');
	};  
</script>
@endsection