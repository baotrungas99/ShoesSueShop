@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Customer information
    </div>
    <div class="table-responsive">

                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Shipping information
    </div>
    <div class="table-responsive">

                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Recived Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Note</th>
            <th>Method payment</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_note}}</td>
            <td>
                @if($shipping->shipping_methode==0)
                    Direct Bank Transfer
                @elseif($shipping->shipping_methode==1)
                    Hand Cash Payment
                @else
                    Paypal
                @endif
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Orders list Details
    </div>

    <div class="table-responsive">

                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>

      <table class="table table-responsive">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <i>No.</i>
              </label>
            </th>
            <th>Product name</th>
            <th>Quantity in stock</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Fee ship</th>
            <th>Coupon</th>
            <th>Total</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @php $i=0;$total=0; @endphp
            @foreach ($order_details as $key => $details)
          <tr class="color_qty_{{$details->product_id}}">
            @php
            $i++;
            $subtotal = $details->product_price*$details->product_sales_quantity;
            $total+=$subtotal;
            @endphp
            <td><label class="i-checks m-b-none"><i>{{$i}}</i></label></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->product_quantity}}</td>
            <td>
                <input type="number" {{$order_status == 2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" min="1" name="product_sales_quantity" value="{{$details->product_sales_quantity}}"/>

                <input type="hidden" class="order_qty_storage_{{$details->product_id}}" name="order_qty_storage" value="{{$details->product->product_quantity}}">

                <input type="hidden" class="order_code" name="order_code" value="{{$details->order_code}}">
                <input type="hidden" class="order_product_id" name="order_product_id" value="{{$details->product_id}}">
                @if($order_status != 2)
                <button class="btn btn-primary update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order">Update</button>
                @endif
            </td>
            <td>${{number_format($details->product_price)}}</td>
            <td>${{number_format($details->product_feeship)}}</td>
            <td>@if($details->product_coupon!="no")
                     {{$details->product_coupon}}
                @else
                    No coupon
                @endif
            </td>
            <td>${{number_format($subtotal)}}</td>
          </tr>
          @endforeach
          <tr>
              @php
              $total_coupon =0;
              @endphp
                <td>
                @foreach ($order_details as $key => $details)
                    @if($coupon_condition==1)
                            @php
                            $total_add_coupon = ($total*$coupon_number)/100;
                            $total_coupon = $total- $total_add_coupon +$details->product_feeship;
                            @endphp
                    @else
                            @php
                            $total_coupon= $total-$coupon_number + $details->product_feeship;
                            @endphp
                    @endif
                @endforeach
                    Total: ${{number_format($total_coupon)}}
                </td>
          </tr>
          <tr>
               <!-- update order status -->
            <td colspan="6">
                @foreach ($order as $key => $or)
                @if($or->order_status ==1)
                <form>
                    @csrf
                    <select class="form-control order_details">
                        <option value="">------Choose------</option>
                        <option id="{{$or->order_id}}" selected value="1">Unprocessed</option>
                        <option id="{{$or->order_id}}" value="2">Processed</option>
                        <option id="{{$or->order_id}}" value="3">Cancel</option>
                    </select>
                </form>
                @elseif($or->order_status ==2)
                <form>
                    @csrf
                    <select class="form-control order_details">
                        <option value="">------Choose------</option>
                        <option id="{{$or->order_id}}" value="1">Unprocessed</option>
                        <option id="{{$or->order_id}}" selected value="2">Processed</option>
                        <option id="{{$or->order_id}}" value="3">Cancel</option>
                    </select>
                </form>
                @else
                <form>
                    @csrf
                    <select class="form-control order_details">
                        <option value="">------Choose------</option>
                        <option id="{{$or->order_id}}" value="1">Unprocessed</option>
                        <option id="{{$or->order_id}}" value="2">Processed</option>
                        <option id="{{$or->order_id}}" selected value="3">Cancel</option>
                    </select>
                </form>
                @endif
                @endforeach
            </td>
          </tr>
        </tbody>
      </table>
      <a target="_blank_" href="{{url('/print-orders/'.$details->order_code)}}" >Print Order</a>
    </div>

  </div>
</div>

@endsection
