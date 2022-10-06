@extends('layouts.adminapp')

@section('content')
<div class="uk-width-1-1 uk-padding ">
	<div class="uk-flex-between" uk-grid>
		<H3 class="uk-text-bold">Danh sách nhân viên</H3>
		@include('partials/searchbar')
	</div>
	
	<div uk-grid class="uk-flex-between uk-margin-small">
		{{$admins->links()}}
		<button form="create-form" class="uk-icon-button uk-width-auto uk-text-center uk-button-primary uk-padding-small">Thêm nhân viên mới &nbsp;&nbsp;&nbsp; <span uk-icon="plus"></span></button>
		<form hidden id="create-form" action="{{route('admin.hr.create')}}" method="GET">@csrf</form>
	</div>

	<div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">
		<div class="uk-overflow-auto">
			{{-- table --}}
			<table class="uk-table uk-table-middle uk-table-divider">
				<thead>
					<tr>
						<th class="uk-table-shrink">ID</th>
						<th>Tên</th>
						<th class="uk-width-small">Điện thoại</th>
						<th class="uk-table-shrink">Sửa</th>
						<th class="uk-table-shrink">Xóa</th>
					</tr>
				</thead>
				<tbody uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;"> 
					@if(isset($admins))
					@foreach ($admins as $item)
					<tr>
						<td>{{$item->id}}</td>
						<td>{{$item->name}}@if(1 === $item->id) (Tài khoản hiện tại)@endif</td>
						<td class="phone" data-phone="{{$item->phone}}">{{$item->phone}}</td>
						<td><button form="item-{{$item->id}}-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>
						<form id="item-{{$item->id}}-edit-form" method="GET" action="{{route('admin.hr.edit',$item->id)}}" hidden></form>
						@if(1 === $item->id)
						<td><button class="uk-button-danger uk-icon-button" type="button" disabled><span uk-icon="close"></span></button></td>
						@else
						<form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.hr.destroy',$item->id)}}" hidden>@csrf @method('delete')</form>
						<td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td>
						@endif
					</tr>
					@endforeach
					@endif
					
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection