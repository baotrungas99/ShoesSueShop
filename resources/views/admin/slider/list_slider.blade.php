@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      banner list
    </div>
    <div class="table-responsive">

                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">',$message,'</span>';
                                Session::put('message',null);
                            }
                        ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Name</th>
            <th>image</th>
            <th>Description</th>
            <th>status</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_slide as $key => $slide)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$slide->slider_name}}</td>
            <td><img src="public/upload/slider/{{$slide->slider_image}}" hight ="100" width="100"></td>
            <td>{{$slide->slider_desc}}</td>
            <td><span class="text-ellipsis">
              <?php
               if($slide->slider_status==0){
               ?>
                <a href="{{URL::to('/unactive-slider/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"> </span></a>
               <?php
               }else{
              ?>
              <a href="{{URL::to('/active-slider/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"> </span></a>
              <?php
            }
            ?>
            </span></td>
            <td>
              <a  href="{{URL::to('/delete-slide-product/'.$slide->slider_id)}}" onclick="return confirm('Are you sure?')"  class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
            @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
