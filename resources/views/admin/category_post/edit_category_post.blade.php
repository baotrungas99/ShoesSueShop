@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            update post Product
                        </header>

                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">
                            @foreach($edit_category_post as $key => $edit_value)
                            <div class="position-center">
                                <form role="form"action="{{URL::to('/update-category-post/'.$edit_value->category_post_id )}}"method="post" >
                                    {{csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category post Name</label>
                                    <input type="text" value="{{$edit_value->cate_post_name}}" name = "category_post_name" class="form-control" id="slug" placeholder="Name" onkeyup="ChangeToSlug();">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category post slug</label>
                                    <input type="text" value="{{$edit_value->cate_post_slug}}" name = "slug_category_post" class="form-control" id="convert_slug" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "category_post_description" class="ckeditor form-control" id="5">{{$edit_value->cate_post_desc}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Keywords</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "category_post_keywords" class=" form-control" id="2" placeholder="Category details" required>{{$edit_value->meta_keywords}}
                                    </textarea>
                                </div>
                                <button type="submit" name="update_category_post" class="btn btn-info">update</button>
                                </form>
                            </div>
                            @endforeach

                    </section>

            </div>

@endsection
