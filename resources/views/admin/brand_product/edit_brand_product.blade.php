@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            update brand Product
                        </header>

                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">
                            @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form"action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}"method="post" >
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">brand Product Name</label>
                                    <input type="text" value="{{$edit_value->brand_name}}" name = "brand_product_name" class="form-control" id="slug" placeholder="Name" onkeyup="ChangeToSlug();">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">brand Product slug</label>
                                    <input type="text" value="{{$edit_value->brand_slug}}" name = "brand_product_slug" class="form-control" id="convert_slug" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "brand_product_description" class="ckeditor form-control" id="5">{{$edit_value->brand_description}}
                                    </textarea>
                                </div>
                                <button type="submit" name="update_brand_product" class="btn btn-info">update</button>
                                </form>
                            </div>
                            @endforeach

                    </section>

            </div>

@endsection
