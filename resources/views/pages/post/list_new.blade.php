@extends('layout')
@section('content')
					<div class="blog-post-area">
                        @foreach($category_post_name as $key => $value)
						<h2 class="title text-center">Latest From {{$value->cate_post_name}}</h2>
                        @endforeach
                        @foreach($post_by_id as $key => $post)
						<div class="single-blog-post">
							<h3>{{$post->post_title}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
                            <div class="col-md-4">
                                <a href="">
                                    <img style="width:auto; height:150px" src="{{url('public/upload/post/'.$post->post_image)}}" alt="">
                                </a>
                            </div >
                            <div class="col-md-8">
                                <p>{!!$post->post_desc!!}</p>
                                <a  class="btn btn-primary" href="{{url('/detail-post/'.$post->cate_post_slug)}}">Read More</a>
                            </div> <br/>
                            <div class="col-md-12">
                                <ul class="pagination">
                                    <li><a href="" class="active">1</a></li>
                                    <li><a href="">2</a></li>
                                    <li><a href="">3</a></li>
                                    <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
                                </ul>
                            </div>
                            @endforeach
					</div>

@endsection
