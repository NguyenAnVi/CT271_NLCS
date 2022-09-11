@extends('layouts.adminapp')
@section('content')
<div class="uk-container uk-padding-small ">
    <div>
        <ul class="uk-child-width-expand" uk-tab>
            <li onclick="UIkit.slider('#slcontent').show('0');" class="uk-active"><a href=""><h3 class="uk-text-bold">Danh sách nhân viên {{Auth::guard('admin')->user()}}</h3></a></li>
            <li onclick="UIkit.slider('#slcontent').show('1');" class="" ><a href="#"><h3 class="uk-text-bold">Thêm mới</h3></a></li>
        </ul>
    </div>
    <div id="slcontent" uk-slider="center:true; autoplay:false; finite:true; index:0; draggable:false">
        <ul class="uk-slider-items uk-grid uk-grid-match">
            <li class="uk-width-1-1">
                <div class="uk-cover-container">
                    {{-- table --}}
                    <table class="uk-table uk-table-middle uk-table-divider">
                        <thead>
                            <tr>
                                <th class="uk-width-small">ID</th>
                                <th>Tên</th>
                                <th class="uk-width-small">Điện thoại</th>
                                <th class="uk-table-shrink">Sửa</th>
                                <th class="uk-table-shrink">Xóa</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @if(isset($admins))
                            @foreach ($admins as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}@if(1 === $item->id) (Tài khoản hiện tại)@endif</td>
                                <td class="phone" data-phone="{{$item->phone}}">{{$item->phone}}</td>
                                @if(1 === $item->id)
                                <td><button class="uk-button-primary" type="button" disabled><span uk-icon="pencil"></span></button></td>
                                <td><button class="uk-button-danger" type="button" disabled><span uk-icon="close"></span></button></td>
                                @else
                                <form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.hr.destroy',['id' => $item->id])}}" hidden>
                                    @csrf
                                    @method('delete')
                                </form>
                                <td><button class="uk-button-primary" type="button"><span uk-icon="pencil"></span></button></td>
                                <td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger" type="submit"><span uk-icon="close"></span></button></td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </li>
            <li id="add" class="uk-width-1-1">
                <div class="uk-cover-container">
                    {{-- adding form --}}
                    <form id="register-form" 
                          class="uk-grid-small uk-form" 
                          method="POST" 
                          action="{{ route('admin.hr.create') }}" 
                          uk-grid="">
                        @csrf
                        <div class="uk-width-1-2@s">
                            <input autofocus tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" type="text" name="name" placeholder="Họ và tên" required>
                            @error('name')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
    
                        <div class="uk-width-1-2@s">
                            <input tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('phone') uk-form-danger @enderror" type="phone" name="phone" placeholder="Điện thoại" required>
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
                            <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="register-form">Đăng ký</button>
                        </div>
                    </form>
                    
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection