@extends('admin_layout')
@section('admin_content')
<div class="row">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Category post
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
                                <form role="form"action="{{URL::to('/save-category-post')}}"method="post" >
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category post Name</label>
                                    <input type="text"  class="form-control" onkeyup="ChangeToSlug();" name="category_post_name"  id="slug" placeholder="Name"required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="slug_category_post" class="form-control" id="convert_slug" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "category_post_description" class="ckeditor form-control" id="2" placeholder="Category details" required>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Keywords</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "category_post_keywords" class=" form-control" id="2" placeholder="Category details" required>
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Show</label>
                                    <select name="category_post_status" class="form-control input-sm m-bot15">
                                        <option value="0">Show</option>
                                        <option value="1">Hide</option>

                                    </select>
                                </div>

                                <button type="submit" name="add_category_post" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
