@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Orders list
    </div>
    <div class="row w3-res-tb">
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
            <th>No.</th>
            <th>Order Code</th>
            <th>Order status</th>
            <th>Order Date time</th>
            <th></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @php
             $i=0;
             @endphp
            @foreach($order as $key => $ord)
            @php
            $i++;
            @endphp
          <tr>
            <td><label class="i-checks m-b-none"><i>{{$i}}</i></label></td>
            <td>{{$ord->order_code}}</td>

            <td>
                @if($ord->order_status==1)
                            New order
                @elseif($ord->order_status==2)
                            order checked
                @else
                            order cancelled
                @endif
            </td>
            <td>{{$ord->created_at}}</td>

            <td>
              <a href="{{URL::to('/view-orders/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">

                <i class="fa fa-eye "></i></a>

              <a  href="{{URL::to('/delete-orders/'.$ord->order_code)}}" onclick="return confirm('Are you sure?')"  class="active styling-edit" ui-toggle-class="">

                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
            @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
