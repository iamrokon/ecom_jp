<div class="modal fade" id="orderDetails" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
            <div class="card-header">
                <h5 class="mb-0">履歴詳細</h5>
            </div>
            <div id="error_update_user" style="padding-left: 9px;"></div><br>
            <div class="card-body">
                <h5 class="text-warning mb-3">ご注文履歴</h5>
                <div class="table-responsive">
                    <table class="table custom-info-table user-resp-table mb-4">
                        <tr>
                            <td style="width: 30%;min-width: 160px;">ご注文日 :</td>
                            <td style="min-width: 350px;">@if(isset($orderItemList)){{substr($orderItemList[0]->order_date,0,10)}}@endif</td>
                        </tr>
                        <tr>
                            <td>お届け先名 :</td>
                            <td>@if(isset($orderItemList)){{$orderItemList[0]->delivery_name}}@endif</td>
                        </tr>
                        <tr>
                            <td>ご注文番号 :</td>
                            <td>@if(isset($orderItemList)){{$orderItemList[0]->order_no}}@endif</td>
                        </tr>
                        <tr>
                            <td>お問い合せ伝票番号 :</td>
                            <td>@if(isset($orderItemList)){{$orderItemList[0]->toiawasebango}}@endif</td>
                        </tr>
                        <tr>
                            <td>お支払方法 :</td>
                            <td>@if(isset($orderItemList)){{$orderItemList[0]->kessaihouhou}}@endif</td>
                        </tr>
                        <tr>
                            <td>お届け希望日時 :</td>
                            <td>@if(isset($orderItemList)){{$orderItemList[0]->delivery_date}} {{$orderItemList[0]->delivery_time}}@endif</td>
                        </tr>
                        <tr>
                            <td>お支払合計 :</td>
                            <td>¥@if(isset($orderItemList)){{number_format($orderItemList[0]->total_payment)}}@endif</td>
                        </tr>
                        <tr>
                            <td>スターテス :</td>
                            <td>@if(isset($orderItemList)){{$orderItemList[0]->status}}@endif</td>
                        </tr>
                    </table>
                </div>

                <h5 class="text-warning mb-3">ご注文商品一覧</h5>

                <div class="table-responsive">
                    <table class="table custom-info-table user-resp-table mb-4">
                        <thead>
                            <tr>
                                <th>商品名</th>
                                <th>税込単価</th>
                                <th>注文数</th>
                                <th>小計</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sub_total = 0;
                            @endphp
                            @if(isset($orderItemList))
                                @foreach($orderItemList as $order_item)
                                <tr>
                                    <td style="border-bottom: 1px solid #e2e9e1;">{{$order_item->product_name}}</td>
                                    <td class="text-right" style="border-bottom: 1px solid #e2e9e1;">¥{{number_format($order_item->price)}}</td>
                                    <td style="border-bottom: 1px solid #e2e9e1;">{{$order_item->qty}}</td>
                                    <td class="text-right" style="border-bottom: 1px solid #e2e9e1;">¥{{number_format($order_item->price * $order_item->qty)}}</td>
                                </tr>
                                @php
                                $sub_total = $sub_total + ($order_item->price * $order_item->qty);
                                @endphp
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="3" class="text-right border-0">商品合計:</td>
                                <td class="text-right border-0">¥@if(isset($orderItemList)){{number_format($sub_total)}}@endif</td>
                            </tr>
                            
                            <tr>
                                <td colspan="3" class="text-right border-0">代引手数料:</td>
                                <td class="text-right border-0">¥@if(isset($orderItemList)){{number_format($orderItemList[0]->settlement_charge)}}@endif</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right border-0">送料:</td>
                                <td class="text-right border-0">¥@if(isset($orderItemList)){{number_format($orderItemList[0]->delivery_charge)}}@endif</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right border-0">お支払合計:</td>
                                <td class="text-right border-0">¥@if(isset($orderItemList)){{number_format($orderItemList[0]->total_payment)}}@endif</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 text-center">

                    <button type="button" onclick="hideOrderDetailsModal()" class="btn btn-fill-out btn-sm submit" name="submit" value="Submit">ご注文履歴一覧に戻る</button>
                </div>
            </div> 
          
        </div>
      </div>
     
    </div>
  </div>
</div>
