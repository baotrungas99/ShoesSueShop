@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Product
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
                                <form role="form"action="{{URL::to('/save-product')}}"method="post" enctype="multipart/form-data"id="validatetForm">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input data-validation="required" data-validation-length="min10"  type="text" name = "product_name" class="form-control" id="exampleInputEmail1" placeholder="Name"required onkeyup="ChangeToSlug();">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control " id="convert_slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product price</label>
                                    <input  data-validation="number" type="number" name = "product_price" class="form-control" id="exampleInputEmail1" placeholder="price"required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product quantity</label>
                                    <input  data-validation="number" type="number" name = "product_quantity" class="form-control" id="exampleInputEmail1" placeholder="price"required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product image</label>
                                    <input  data-validation="required" type="file" name = "product_image" class="form-control" id="exampleInputEmail1"required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea  data-validation="required" style="resize:none" rows="8" type="password" name = "product_description" class="ckeditor form-control" id="alo1" placeholder="product details"required>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Content</label>
                                    <textarea  data-validation="required" style="resize:none" rows="8" type="password" name = "product_content" class="ckeditor form-control" id="exampleInputPassword1" placeholder="product content" required>
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">category</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">

                                        @foreach($cate_product as $key => $cate)
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">brand</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">

                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Show</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Show</option>
                                        <option value="1">Hide</option>
                                    </select>
                                </div>

                            <button type="submit" name="add_product" class="btn btn-info">Add</button>
                         </form>
                    </div>

                </div>
            </section>

    </div>

@endsection
