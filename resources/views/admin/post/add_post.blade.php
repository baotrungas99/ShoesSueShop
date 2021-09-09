@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add post
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
                                <form role="form"action="{{url('/save-post')}}"method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post Title</label>
                                    <input type="text" name = "post_title" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Slug">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Post Summary</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "post_desc" class="ckeditor form-control" id="1" placeholder="post details">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description and Content</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "post_content" class="ckeditor form-control" id="1" placeholder="post details">
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keywords</label>
                                    <input type="text" name="post_meta_keyword" class="form-control" id="keywords">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Description</label>
                                    <input type="text" name="post_meta_desc" class="form-control" id="keywords">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post image</label>
                                    <input  data-validation="required" type="file" name = "post_image" class="form-control" id="exampleInputEmail1"required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">category Post</label>
                                    <select name="cate_post_id" class="form-control input-sm m-bot15">

                                        @foreach($cate_post as $key => $cate)
                                            <option value="{{$cate->category_post_id}}">{{$cate->cate_post_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Show</label>
                                    <select name="post_status" class="form-control input-sm m-bot15">
                                        <option value="0">Show</option>
                                        <option value="1">Hide</option>

                                    </select>
                                </div>

                                <button type="submit" name="add_post" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
