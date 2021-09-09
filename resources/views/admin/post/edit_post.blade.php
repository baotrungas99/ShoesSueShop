@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit post
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
                            @foreach($post as $key => $po)
                                <form role="form"action="{{url('/update-post/'.$po->post_id)}}"method="post" enctype="multipart/form-data">
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post Title</label>
                                    <input type="text" name = "post_title" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Name" value="{{$po->post_title}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Slug" value="{{$po->post_slug}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Post Summary</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "post_desc" class="ckeditor form-control" id="1" placeholder="post details" >{{$po->post_desc}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description and Content</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "post_content" class="ckeditor form-control" id="1" placeholder="post details">{{$po->post_content}}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keywords</label>
                                    <input type="text" name="post_meta_keyword" class="form-control" id="keywords"value="{{$po->post_meta_keyword}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Description</label>
                                    <input type="text" name="post_meta_desc" class="form-control" id="keywords"value="{{$po->post_meta_desc}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Post image</label>
                                    <input type="file" name = "post_image" class="form-control" id="exampleInputEmail1">
                                    <image src="{{URL::to('public/upload/post/'.$po->post_image)}}" hight="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">category Post</label>
                                    <select name="cate_post_id" class="form-control input-sm m-bot15">

                                        @foreach($cate_post as $key => $cate)
                                        @if($cate->category_post_id == $po->cate_post_id)
                                            <option selected value="{{$cate->category_post_id}}">{{$cate->cate_post_name}}</option>
                                        @else
                                             <option value="{{$cate->category_post_id}}">{{$cate->cate_post_name}}</option>
                                        @endif
                                        @endforeach

                                    </select>
                                </div>

                                <button type="submit" name="update_post" class="btn btn-info">update</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>

@endsection
