@extends('front.master')

@section('title', 'Checkout')

@section('content')



      <!-- ***** Main Banner Area Start ***** -->
 <div style="margin:120px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Checkout</h2>
                    <span>checkout page</span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ***** Main Banner Area End ***** -->



        <div class="container mt-2">

            <div class="alert alert-success">
                <h2>Payment Successfully</h2>
            </div>

        </div>

        <div class="container mt-5">
            <h4 class="text-center text-muted">Your cart is empty</h4>
        </div>


    <div class="container mt-5">
        <h4 class="text-center text-muted">Please log in to view your cart</h4>
    </div>



@endsection
