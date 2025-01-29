@extends('front.master')

@section('title', 'Cart')

@section('content')

 <!-- ***** Main Banner Area Start ***** -->
 <div style="margin:120px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Shopping Cart</h2>
                    <span>You Cart In You Hand</span>
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
            @if(session('msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Auth::user()->carts as $cart)
                        <tr>
                            <td>
                                <img src="{{ asset('images/'.$cart->product->image->path) }}" alt="{{ $cart->product->trans_name }}" width="50" class="rounded">
                            </td>
                            <td>{{ $cart->product->trans_name }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>${{ number_format($cart->product->price, 2) }}</td>
                            <td>${{ number_format($cart->quantity * $cart->product->price, 2) }}</td>
                            <td class="text-center">
                                <a style="color: red; text-decoration: none;" href="{{route('cart.delete',$cart->id)}}" class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-trash"></i>
                                    <span class="ms-1">Remove</span>
                                </a>
                            </td>                            @php
                            $total += $cart->quantity * $cart->price;
                            @endphp
                        </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-end">Grand Total:</th>
                        <th>${{ number_format($total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{route('front.checkout')}}" class="btn btn-primary btn-lg btn-dark">Checkout</a>
            </div>
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
