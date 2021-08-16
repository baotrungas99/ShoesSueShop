@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">


			<div class="review-payment">
				<h2>thank you for your order in my Shop</h2>
			</div>


            <form method="post" action="{{URL::to('/order-place')}}">
                {{csrf_field()}}
                <div class="payment-options">



                </div>
            </form>

		</div>
	</section> <!--/#cart_items-->

@endsection
