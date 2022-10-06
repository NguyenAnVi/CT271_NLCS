<?php use App\Models\SaleOff;?>
<tr>
 <td>{{$item->id}}</td>
 <td>{!!getCollection($item->images)!!}</td>
 <td>{{$item->name}}</td>
 <td>{{number_format($item->price, 0, ',', '.')}} đ</td>
 <form id="item-{{$item->id}}-destroy-form" method="POST" action="{{route('admin.product.destroy',$item->id)}}" hidden>@csrf @method('delete')</form>
 <form id="item-{{$item->id}}-edit-form" method="GET" action="{{route('admin.product.edit',$item->id)}}" hidden></form>
    <?php $item_saleoff = SaleOff::where('id', $item->saleoff_id)->first() ?>
 <td class="uk-text-truncate" uk-tooltip="@if(isset($item_saleoff->amount))Giảm @if($item_saleoff->amount != 0){{number_format($item_saleoff->amount, 0, ',', '.')}} đ @else {{$item_saleoff->percent}} % @endif @endif ">
@if(isset($item_saleoff->name)){{$item_saleoff->name}}@endif</td>
 <td><button form="item-{{$item->id}}-edit-form" class="uk-button-primary uk-icon-button" type="submit"><span uk-icon="pencil"></span></button></td>
 <td><button form="item-{{$item->id}}-destroy-form" class="uk-button-danger uk-icon-button" type="submit"><span uk-icon="close"></span></button></td>
 </tr>