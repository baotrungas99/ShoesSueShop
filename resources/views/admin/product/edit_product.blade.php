@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update Product
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

                            @foreach($edit_product as $key => $pro)
                                <form role="form"action="{{URL::to('/update-product/'.$pro->product_id)}}"method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" name = "product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control" id="exampleInputEmail1" value="{{$pro->product_slug}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product quantity</label>
                                    <input type="text" name = "product_quantity" class="form-control" id="exampleInputEmail1" value="{{$pro->product_quantity}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product price</label>
                                    <input type="text" name = "product_price" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product image</label>
                                    <input type="file" name = "product_image" class="form-control" id="exampleInputEmail1">
                                    <image src="{{URL::to('public/upload/product/'.$pro->product_image)}}" hight="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "product_description" class="ckeditor form-control" id="7" >{{$pro->product_description}}</textarea>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Content</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "product_content" class="ckeditor form-control" id="8" >{{$pro->product_content}}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">category</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">

                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->category_id == $pro->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @else
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">brand</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">

                                        @foreach($brand_product as $key => $brand)
                                            @if($brand->brand_id == $pro->brand_id)
                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
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
                            @endforeach
                            <button type="submit" name="add_product" class="btn btn-info">update</button>
                         </form>
                    </div>

                </div>
            </section>

    </div>

@endsection
