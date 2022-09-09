<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Nhà thuốc Sức Khỏe') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/uikit.css') }}" rel="stylesheet">
</head>
<body style="min-height: 100vh">
<div id="app">
    <div class="uk-background-primary uk-light uk-position-z-index" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
        <nav class="uk-navbar-container uk-navbar-transparent">
            <div class="uk-container">
                <div class="uk-navbar" data-uk-navbar>
                    <div class="uk-navbar-left">
                        <a class="uk-navbar-item uk-logo" href="/">{{ config('app.name', 'Laravel') }}</a>
                        <ul class="uk-navbar-nav">
                            <li>
                                <button class="uk-button uk-button-default" type="button"><span uk-icon="menu"></span>  Danh mục</button>
                                <div uk-dropdown="stretch:true; mode: click; animation: uk-animation-slide-top-small; animate-out:true">
                                    <ul class="uk-nav uk-dropdown-nav">
                                        
                                        <li class="uk-active"><a href="#" class="">Danhmuc</a></li>
                                    </ul>    
                                </div>
                                
                                {{-- <div class="uk-navbar-dropdown uk-navbar-dropdown-width-3">
                                    <div class="uk-navbar-dropdown-grid uk-child-width-1-3" data-uk-grid>
                                        <div>
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li class="uk-nav-header">Laravel</li>
                                                
                                            </ul>
                                        </div>
                                        <div>
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li class="uk-nav-header">UIkit</li>
                                                
                                            </ul>
                                        </div>
                                        <div>
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li class="uk-nav-header">Vue.js</li>
                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}
                            </li>
                        </ul>
                    </div>
                    <div class="uk-navbar-right">
                        <a class="uk-navbar-toggle" uk-search-icon href="#"></a>
                        <div class="uk-drop" uk-drop="mode: click; pos: left-center; offset: 0">
                            <form class="uk-search uk-search-navbar uk-width-1-1">
                                <input class="uk-search-input" type="search" placeholder="Từ khóa tìm kiếm" autofocus>
                            </form>
                        </div>

                        <ul class="uk-navbar-nav uk-iconnav"> 
                            {{-- Authentication Links --}}
                            @guest
                                @if (Route::has('login'))
                                    <li>
                                        <a href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                                    </li>
                                @endif
                            @else
                                {{-- Shopping cart --}}
                                <li>
                                    <span uk-icon="icon:cart"></span>
                                    <div id="cart" class="uk-width-1-1@s uk-width-1-2@m"
                                        uk-dropdown="pos: bottom-right; mode: click; animation: uk-animation-slide-top-small;">
                                        @if(isset($cart_item))
                                            <ul class="uk-list">
                                                <li class="uk-nav-header uk-text-bold">Sản phẩm vừa thêm</li>
                                                <li><hr></li>
                                                <li>
                                                    <ul class="uk-list uk-list-large uk-list-divider">
                                                        @foreach($cart_item as $item)
                                                        <li>
                                                            <div uk-grid>
                                                                <div class="uk-width-expand">{{$item['name']}}</div>
                                                                <div class="uk-width-1-4">{{$item['quantity']}}</div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        @else
                                            <div>Chưa có sản phẩm trong giỏ</div>
                                        @endif
                                    </div>
                                </li>

                                <li>
                                    {{-- <a href="#">
                                        {{ Auth::user()->name }}
                                    </a> --}}
                                    <span uk-icon="icon:user"></span>   
                                    <div class="uk-navbar-dropdown" uk-dropdown="pos: bottom-right; mode:click; animation: uk-animation-slide-top-small">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li class="uk-nav-header">
                                                {{__(Auth::user()->name)}}
                                            </li>
                                            <li class="uk-nav-divider"></li>
                                            <li>
                                                <a href="{{ route('admin.logout') }}"
                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    {{ __('Đăng xuất') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    @includeIf('layouts.generalmessage')
    
    <main class="" uk-height-viewport="offset-bottom:true ; offset-top:true">
        @yield('content')
    </main>

    <footer class="uk-section uk-section-xsmall uk-section-secondary">
        <div class="uk-container">
            <div class="uk-grid uk-text-center uk-text-left@s uk-flex-middle" data-uk-grid>
                <div class="uk-text-small uk-text-muted uk-width-1-3@s">
                    ViB1910178@student.ctu.edu.vn
                </div>
                <div class="uk-text-center uk-width-1-3@s">
                    <a target="_blank" href="https://github.com/NguyenAnVi/CT271_NLCS"
                       class="uk-icon-button" data-uk-icon="github"></a>
                </div>
                <div class="uk-text-small uk-text-muted uk-text-center uk-text-right@s uk-width-1-3@s">
                    Built with <a target="_blank" href="http://getuikit.com"><span data-uk-icon="uikit"></span></a>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{ asset('js/uikit.js') }}" defer></script>
<script src="{{ asset('js/uikit-icons.js') }}" defer></script>
</body>
</html>
