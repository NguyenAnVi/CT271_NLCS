
@extends('layouts.adminapp')
@section('content')
    <style>
        img~div{
            padding: 2%;
            padding-top: 3%;
            border-radius: 50px;
            background-color: rgb(0, 0, 0);
            back
        }
    </style>
    <div id="list-functions" class="uk-padding uk-padding-remove-horizontal uk-child-width-1-2@m uk-grid-match uk-grid-medium uk-text-center" uk-grid="">
        <div>
            <a href="{{route('admin.product')}}">
                <div class="uk-card uk-card-secondary uk-card-body uk-transition-toggle">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="{{asset('logo/ProductManager.jpg')}}" alt="">
                    <div class="uk-position-center">
                        <div class=""><h2 class="">QL Sản Phẩm</h2></div>
                    </div>
                </div>
            </a>  
        </div>
        <div>
            <a href="">
                <div class="uk-card uk-card-secondary uk-card-body uk-transition-toggle">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="{{asset('logo/HR.jpg')}}" alt="">
                    <div class="uk-position-center">
                        <div class=""><h2 class="">QL CTKM</h2></div>
                        {{-- <div class="uk-transition-scale-up"><h3 class="">Create new Admin account</h3></div> --}}
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a href="{{route('admin.customer')}}">
                <div class="uk-card uk-card-secondary uk-card-body uk-transition-toggle">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="{{asset('logo/HR.jpg')}}" alt="">
                    <div class="uk-position-center">
                        <div class=""><h2 class="">QL Khách hàng</h2></div>
                        {{-- <div class="uk-transition-scale-up"><h3 class="">Create new Admin account</h3></div> --}}
                    </div>
                </div>
            </a>
        </div>
        @if(Auth::guard('admin')->user()->id === 1)
        <div>
            <a href="{{route('admin.hr')}}">
                <div class="uk-card uk-card-secondary uk-card-body uk-transition-toggle">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="{{asset('logo/HR.jpg')}}" alt="">
                    <div class="uk-position-center">
                        <div class=""><h2 class="">QL Nhân sự</h2></div>
                        {{-- <div class="uk-transition-scale-up"><h3 class="">Create new Admin account</h3></div> --}}
                    </div>
                </div>
            </a>
        </div>
        @endif
        <div>
            <a href="">
                <div class="uk-card uk-card-secondary uk-card-body uk-transition-toggle">
                    <img class="uk-transition-scale-up uk-transition-opaque" src="{{asset('logo/HR.jpg')}}" alt="">
                    <div class="uk-position-center">
                        <div class=""><h2 class="">QL Hóa đơn</h2></div>
                        {{-- <div class="uk-transition-scale-up"><h3 class="">Create new Admin account</h3></div> --}}
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
