@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     poduct list
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
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
            <th>Title</th>
            <th>image</th>
            <th>slug</th>
            <th>Description</th>
            <th>Keyword</th>
            <th>category</th>
            <th>show</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_post as $key => $po)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$po->post_title}}</td>
            <td><img src="public/upload/post/{{$po->post_image}}" hight ="100" width="100"></td>
            <td>{{$po->post_slug}}</td>
            <td>{!! $po->post_desc !!}</td>
            <td>{{$po->post_meta_keyword}}</td>
            <td>{{$po->cate_post_name}}</td>

            <td><span class="text-ellipsis">
              <?php
               if($po->post_status==0){
               ?>
                <a href="{{URL::to('/unactive-post/'.$po->post_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"> </span></a>
               <?php
               }else{
              ?>
              <a href="{{URL::to('/active-post/'.$po->post_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"> </span></a>
              <?php
            }
            ?>
            </span></td>

            <td>
              <a href="{{URL::to('/edit-post/'.$po->post_id)}}" class="active styling-edit" ui-toggle-class="">

                <i class="fa fa-pencil-square-o"></i></a>

              <a  href="{{URL::to('/delete-post/'.$po->post_id)}}" onclick="return confirm('Are you sure?')"  class="active styling-edit" ui-toggle-class="">

                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
            @endforeach

        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

            <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
            </div>
            <div class="col-sm-7 text-right text-center-xs">
                <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!!$all_post->links()!!}
                </ul>
            </div>
        </div>
    </footer>
  </div>
</div>

@endsection
