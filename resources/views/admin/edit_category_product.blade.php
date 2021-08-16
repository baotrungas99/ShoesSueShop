@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            update Category Product
                        </header>

                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">
                       @foreach($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form"action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}"method="post" >
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Product Name</label>
                                    <input type="text" value="{{$edit_value->category_name}}" name = "category_product_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$edit_value->slug_category_product}}" name="slug_category_product" class="form-control" id="convert_slug" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "category_product_description" class="ckeditor form-control" id="6">{{$edit_value->category_description}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">keywords</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "category_product_keywords" class="ckeditor form-control" id="6">{{$edit_value->meta_keywords}}
                                    </textarea>
                                </div>

                                <button type="submit" name="update_category_product" class="btn btn-info">update</button>
                            </form>
                            </div>

                        </div>
                    </section>
                    @endforeach
            </div>

@endsection
