@if (count($items)!=0)
  <table class="uk-table uk-table-hover uk-table-divider">
    <thead class="uk-text-bold">
      <td>Ngày đặt hàng</td>
      <td>Địa chỉ</td>
      <td class="uk-text-right">Thanh toán</td>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{$item->created_at}}</td>
          <td>{{urldecode($item->address)}}</td>
          <td class="uk-text-right">{{$item->total}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>  
@else
  <div class="uk-text-center uk-width-1-1 uk-padding-large" >
    Không có đơn hàng nào
  </div>
@endif
  