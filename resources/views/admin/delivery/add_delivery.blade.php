@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Delivery Fee
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
                                <form >
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Choose Province</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                        <option value="">Choose Province City</option>
                                        @foreach($province as $key => $value)
                                        <option value="{{$value->matp}}">{{$value->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Choose District</label>
                                    <select name="district" id="district" class="form-control input-sm m-bot15 choose district">
                                    <option value="">Choose District</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Choose Wards</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">Choose Wards</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fee delivery</label>
                                    <input type="text" name = "fee_ship" class="form-control fee_ship" >
                                </div>
                                <button type="button" name="add_delivery" class="btn btn-info add-delivery">Add Fee Delivery</button>
                                </form>
                            </div><br>
                            <div id="load_delivery" >

                        </div>
                        </div>

                    </section>
            </div>
</div>

@endsection
