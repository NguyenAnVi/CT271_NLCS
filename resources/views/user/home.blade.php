@extends('user.layouts.app')

@section('css')
    
@endsection

@section('content')
<div class="uk-flex uk-flex-column">
  {{-- saleoff banner --}}
  <div class="uk-flex uk-height-1-1 uk-flex-wrap uk-margin-bottom">
    {{-- slideshow --}}
    <div id="slideshow" class="uk-width-2-3@l uk-height-medium" style="overflow: hidden">
      <div class="uk-position-relative uk-visible-toggle uk-light  uk-height-1-1" tabindex="1" uk-slideshow="animation: pull; autoplay:true; "  >
        <ul class="uk-slideshow-items">
          @foreach ($saleoffs as $item)
          @if($item->imageurl!="")
            <li>
              <img class=" uk-padding-small uk-comment-avatar uk-object-cover uk-width-1-1 uk-height-medium" src="{!!$item->imageurl!!}">
            </li>
          @endif
          @endforeach
        </ul>
        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
      </div>
    </div>
    {{-- listview --}}
    <div class="uk-width-1-3@l uk-height-1-1 uk-overflow-auto uk-height-medium">
      <div class="uk-flex uk-flex-column uk-width-1-1">
        @foreach ($saleoffs as $item)
          @if($item->imageurl!="")
            <div class="uk-card uk-card-default">
              <img class="uk-width-1-1 uk-padding-small uk-padding-remove-verti" src="{!!$item->imageurl!!}">
            </div>
          @endif
          @endforeach
      </div>
    </div>
  </div>

  {{-- categories --}}
  <div class="uk-flex uk-height-1-1 uk-flex-column uk-child-width-1-1 uk-card uk-card-default uk-card-hover uk-padding-small uk-margin-bottom">
    <div id="content" class="uk-card-body uk-padding-small uk-padding-remove-horizontal">
      <div class="uk-flex uk-flex-wrap uk-flex-wrap-around uk-flex-center">
        @foreach($categories as $item)
            <button class="uk-button uk-button-text uk-flex uk-flex-center uk-flex-middle uk-margin-right uk-text-bold uk-text-{{(['primary', 'secondary', 'success', 'warning', 'danger'])[rand(0,4)]}}">{{$item->name}}</button>
        @endforeach
      </div>
    </div>
  </div>

  {{-- products_random --}}
  <div class="uk-flex uk-height-1-1 uk-flex-column uk-child-width-1-1 uk-card uk-card-default uk-card-hover uk-padding-small  uk-margin-bottom">
    <div id="title" class="uk-flex uk-flex-between uk-card-title">
      <div class="uk-width-expand">Sản phẩm nổi bật</div>
      <div><button class="uk-button uk-button-text" onclick="allcategories();">Xem thêm</button><span uk-icon="chevron-right"></span></div>
    </div>
    <hr>
    <div id="content" class="uk-card-body uk-padding-small uk-padding-remove-horizontal">
      <div class="uk-flex uk-flex-wrap">
        @foreach ($products as $item)
        <div data-type="product" data-id="{{$item->id}}" class="uk-padding-small uk-padding-remove-left uk-padding-remove-top uk-width-1-2 uk-width-1-3@s uk-width-1-4@m uk-width-1-6@l">
          <div class="uk-card uk-card-secondary uk-border-rounded uk-overflow-hidden">
            <div class="product-image uk-padding-small">
              <img style="aspect-ratio:1/1;" class="uk-object-cover" src="{{getImageAt($item->images, 0)}}" alt="">
            </div>
            <div class="product-title uk-padding-small uk-flex uk-flex-column uk-flex-between" style="height:5rem">
              <div style="height: 3rem;" class="uk-overflow-hidden"><p>{{$item->name}}</p></div>
              <div style="height:2rem;" class="uk-flex uk-flex-between">
                <div><p>{{$item->price}}</p></div><div><p class="uk-emphasis">Đã bán 0</p></div>
              </div>
              
            </div>  
          </div>
        </div>
        @endforeach
      </div>
      
    </div>
  </div>

  {{-- saleoff_products --}}
  <div class="uk-flex uk-height-1-1 uk-flex-column uk-child-width-1-1 uk-card uk-card-default uk-card-hover uk-padding-small  uk-margin-bottom">
    <div id="title" class="uk-flex uk-flex-between uk-card-title">
      <div class="uk-width-expand">💥 Khuyến mãi có hạn 💥</div>
      <div><button class="uk-button uk-button-text" onclick="allcategories();">Xem thêm</button><span uk-icon="chevron-right"></span></div>
    </div>
    <hr>
    <div id="content" class="uk-card-body uk-padding-small uk-padding-remove-horizontal">
      <div uk-filter="target: .js-filter">
        <ul class="uk-subnav uk-subnav-pill">
            <li uk-filter-control=".tag-white"><a href="#">White</a></li>
            <li uk-filter-control=".tag-blue"><a href="#">Blue</a></li>
            <li uk-filter-control=".tag-black"><a href="#">Black</a></li>
        </ul>
    
        <ul class="js-filter uk-child-width-1-2 uk-child-width-1-3@m uk-text-center" uk-grid>
            <li class="tag-white">
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </li>
            <li class="tag-blue">
                <div class="uk-card uk-card-primary uk-card-body">Item</div>
            </li>
            <li class="tag-white">
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </li>
            <li class="tag-white">
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </li>
            <li class="tag-black">
                <div class="uk-card uk-card-secondary uk-card-body">Item</div>
            </li>
            <li class="tag-black">
                <div class="uk-card uk-card-secondary uk-card-body">Item</div>
            </li>
            <li class="tag-blue">
                <div class="uk-card uk-card-primary uk-card-body">Item</div>
            </li>
            <li class="tag-black">
                <div class="uk-card uk-card-secondary uk-card-body">Item</div>
            </li>
            <li class="tag-blue">
                <div class="uk-card uk-card-primary uk-card-body">Item</div>
            </li>
            <li class="tag-white">
                <div class="uk-card uk-card-default uk-card-body">Item</div>
            </li>
            <li class="tag-blue">
                <div class="uk-card uk-card-primary uk-card-body">Item</div>
            </li>
            <li class="tag-black tag-white">
                <div class="uk-card uk-card-secondary uk-card-body">Item</div>
            </li>
        </ul>
    
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $('[data-type=product]').click(function (){
      let type = $(this).data('type');
      let id = $(this).data('id');
      window.location.href='/'+'show/'+type+'/'+id;
      return;
    });
  });
</script>
@endsection