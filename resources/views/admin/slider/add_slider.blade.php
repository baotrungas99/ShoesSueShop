@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add slide
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
                                <form role="form"action="{{url('/insert-slider')}}"method="post" enctype="multipart/form-data"> 
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slide Name</label>
                                    <input type="text" name = "slider_name" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">image</label>
                                    <input type="file" name="slider_image" class="form-control" id="convert_slug" placeholder="image">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea style="resize:none" rows="8" type="password" name = "slider_desc" class="ckeditor form-control" id="1" placeholder="slide details">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">status</label>
                                    <select name="slider_status" class="form-control input-sm m-bot15">
                                        <option value="0">Show</option>
                                        <option value="1">Hide</option>

                                    </select>
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
