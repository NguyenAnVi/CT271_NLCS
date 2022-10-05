@extends('layouts.adminapp')

@section('css')
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
@endsection

@section('content')
<div class="uk-width-1-1 uk-padding">
    <div class="uk-flex-between" uk-grid>
		<H3 class="uk-text-bold">Danh sách chương trình khuyến mãi</H3>
		{{-- Search field --}}
		<button class="uk-toggle uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small"><span uk-icon="search"></span></button>
		<div class="uk-drop" uk-drop="animation; animate-out:true;mode: click; pos: left-center; offset: 0">
			<form class="uk-search uk-search-default uk-width-1-1">
				<input id="search" class="uk-search-input" type="search" placeholder="Tìm kiếm...">
			</form>
		</div>
	</div>

    <div uk-grid class="uk-flex-between uk-margin-small">
		{{$saleoffs->links()}}
		<button form="create-form" class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small">Thêm CTKM mới &nbsp;&nbsp;&nbsp; <span uk-icon="plus"></span></button>
		<form hidden id="create-form" action="{{route('admin.saleoff.create')}}" method="GET">@csrf</form>
	</div>

    <div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">
        <div class="uk-overflow-auto">
        @if(isset($saleoffs))
            {{-- table --}}
            <table class="uk-table uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-table-shrink">ID</th>
                                                        <th class="uk-width-small"></th>
                        <th>Tên CTKM</th>
                        {{-- <th class="uk-width-small">ChiTiet</th> --}}
                        <th class="uk-width-small">Giá giảm</th>
                        {{-- <th class="uk-width-small">SaleOff</th> --}}
                        {{-- <th class="uk-width-small">HinhAnh</th> --}}
                        <th class="">Ngày bắt đầu</th>
                        <th class="">Ngày hết hạn</th>
                        <th class="uk-table-shrink">Sửa</th>
                        <th class="uk-table-shrink">Xóa</th>
                    </tr>
                </thead>
                <tbody uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;"> 
                    @foreach ($saleoffs as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>
                            @if($item->imageurl!="")
                            <img class="uk-comment-avatar uk-object-cover" width="100"  style="aspect-ratio: 3/1;" src="{{$item->imageurl}}">
                            @endif
                        </td>
                        <td>{{$item->name}}</td>
                        {{-- <td>{{$item->detail}}</td> --}}
                        @if($item->amount>$item->percent)
                        <td>{{$item->amount}} vnđ</td>
                        @else
                        <td>{{$item->percent}}%</td>
                        @endif
                        <td>{{$item->starttime}}</td>
                        <td>{{$item->endtime}}</td>
                        <form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.saleoff.destroy', $item->id)}}" hidden>@csrf @method('delete')</form>
                        <form id="item-{{$item->id}}-edit-form" method="GET" action="{{route('admin.saleoff.edit', $item->id)}}" hidden></form>
                        
                        <td><button form="item-{{$item->id}}-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>
                        <td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$saleoffs->links()}}
        @else
            <div class="uk-position-center">
                Hiện chưa có sản phẩm nào
            </div>
        @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('#search').on('keyup',function(){
		$value = $(this).val();
		$.ajax({
			type: 'get',
			url: '{{route('admin.saleoff.search')}}',
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
                 // for (var i = 0; i < this.files.length; i++) {
                     var reader = new FileReader();
                     reader.onload = imageIsLoaded;
                     reader.readAsDataURL(this.files[0]);
                 // }
             }
         });
     });
     function imageIsLoaded(e) {
         document.getElementById("myImg").innerHTML = "";
         $('#myImg').append('<img src="' + e.target.result + '"">');
     };    
 </script>
@endsection