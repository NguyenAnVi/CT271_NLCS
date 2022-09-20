@extends('layouts.adminapp')
@section('content')
<div class="uk-container uk-padding-small ">
    <div class="uk-width-1-1">
        <div class="uk-cover-container">
            {{-- table --}}
            <table class="uk-table uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-width-small">ID</th>
                        <th>Tên</th>
                        <th class="uk-width-small">Điện thoại</th>
                        <th class="uk-width-small">Điểm tích lũy</th>
                        <th class="uk-table-shrink">Sửa</th>
                        <th class="uk-table-shrink">Xóa</th>
                    </tr>
                </thead>
                <tbody> 
                    @if(isset($users))
                    @foreach ($users as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td class="phone" data-phone="{{$item->phone}}">{{$item->phone}}</td>
                        <td>{{$item->point}}</td>
                        <form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.customer.destroy',['id' => $item->id])}}" hidden>
                            @csrf
                            @method('delete')
                        </form>
                        <form id="item-{{$item->id}}-edit-form" method="GET" action="{{route('admin.customer.edit',['id' => $item->id])}}" hidden>
                        </form>
                        <td><button form="item-{{$item->id}}-edit-form" class="uk-button-primary" type="submit"><span uk-icon="pencil"></span></button></td>
                        <td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger" type="submit"><span uk-icon="close"></span></button></td>
                    </tr>
                    @endforeach
                    @endif
                    
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection