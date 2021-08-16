@extends('admin_layout')
@section('admin_content')
<div class="row">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Category Product
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
                                <form role="form"action="{{URL::to('/save-category-product')}}"method="post" id="commentForm" >
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Product Name</label>
                                    <input type="text"  class="form-control" onkeyup="ChangeToSlug();" name="category_product_name"  id="slug" placeholder="Name"required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="slug_category_product" class="form-control" id="convert_slug" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "category_product_description" class="ckeditor form-control" id="2" placeholder="Category details" required>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Keywords</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "category_product_keywords" class=" form-control" id="2" placeholder="Category details" required>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Show</label>
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Show</option>
                                        <option value="1">Hide</option>

                                    </select>
                                </div>

                                <button type="submit" name="add_category_product" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
