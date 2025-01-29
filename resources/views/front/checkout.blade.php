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

@php
    $total =0;
@endphp
@auth
    @if(Auth::user()->carts->count())
        <div class="container mt-2">


        <script
        src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$id}}"
        integrity="{integrity}"
        crossorigin="anonymous">
        </script>
        <form action="{{route('front.payment')}}" class="paymentWidgets" data-brands="VISA MASTER AMEX MADA"></form>



        </div>
    @else
        <div class="container mt-5">
            <h4 class="text-center text-muted">Your cart is empty</h4>
        </div>
    @endif
@else
    <div class="container mt-5">
        <h4 class="text-center text-muted">Please log in to view your cart</h4>
    </div>
@endauth


@endsection
