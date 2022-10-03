<span uk-icon="menu"  uk-toggle="target: #offcanvas-nav-primary"></span>
<div id="offcanvas-nav-primary" uk-offcanvas="overlay: true; mode:slide">
		<div class="uk-offcanvas-bar uk-flex uk-flex-column">

				<ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical" uk-scrollspy="cls: uk-animation-slide-left; target: li; delay: 100; repeat:true">
						{{-- <li class="uk-active"><a href="#">Active</a></li> --}}
						@if(Auth::guard('admin')->user()->id === 1)
						<li class="uk-parent">
								Quyền root
								<ul class="uk-nav-sub">
										<li><a href="{{route('admin.hr')}}">QL nhân sự</a></li>
										<li><a href="{{route('admin.product')}}">QL khách hàng</a></li>
								</ul>
						</li>
						@endif

						<li class="uk-divider-icon"></li>

						<li class="uk-parent">
							Quyền admin
								<ul class="uk-nav-sub">
									<li><a href="#">QL sản phẩm</a></li>
									<li><a href="#">QL CTKM</a></li>
									<li><a href="#">QL hóa đơn</a></li>
								</ul>
						</li>

						<li class="uk-divider-icon"></li>
						
						{{-- Authentication Links --}}
						@auth('admin')
						<li class="uk-parent">
							<span uk-icon="icon:user"></span> {{Auth::guard('admin')->user()->name}} 
							<ul class="uk-nav-sub">
								<li>
									<a href="{{ route('admin.logout') }}"
								onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										{{ __('Đăng xuất') }}
										<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
										@csrf
								</form>
									</a>
								</li>
							</ul>
						</li>
						@endauth
				</ul>

		</div>
</div>