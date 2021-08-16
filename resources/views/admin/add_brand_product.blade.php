@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add brand Product
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
                                <form role="form"action="{{url('/save-brand-product')}}"method="post" >
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">brand Product Name</label>
                                    <input type="text" name = "brand_product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="brand_slug" class="form-control" id="convert_slug" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "brand_product_description" class="ckeditor form-control" id="1" placeholder="brand details">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keywords</label>
                                    <input type="text" name="brand_keyword" class="form-control" id="keywords">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Show</label>
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Show</option>
                                        <option value="1">Hide</option>

                                    </select>
                                </div>

                                <button type="submit" name="add_brand_product" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
