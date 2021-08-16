@extends('admin_layout')
@section('admin_content')
<div class="row">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Coupon Product
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form"action="{{url('/insert-coupon-code')}}" method="post" id="commentForm" >
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Coupon Name</label>
                                    <input type="text"  class="form-control"  name="coupon_name"  id="" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Coupon code</label>
                                    <input type="text" name="coupon_code" class="form-control" id="" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Number of coupon</label>
                                    <input type="text" name="coupon_times" class="form-control" id=""  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Feature of Coupon</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="0">     Choose     </option>
                                        <option value="1">Percent Discount</option>
                                        <option value="2">Money Discount</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Percent Discount (%) or number discount</label>
                                    <input type="text" name="coupon_number" class="form-control" id=""  required>
                                </div>
                                <button type="submit" name="add_coupon" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
