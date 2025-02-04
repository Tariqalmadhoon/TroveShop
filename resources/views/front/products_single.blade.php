@extends('front.master')

@section('title', 'Product ' . $product->trans_name)
@section('css')
<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

fieldset, label { margin: 0; padding: 0; }
body{ margin: 20px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating {
  border: none;
  float: left;
}

html[dir="rtl"] .rating {
    float: right;
}


.rating > input { display: none; }
.rating > label:before {
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before {
  content: "\f089";
  position: absolute;
}

.rating > label {
  color: #ddd;
 float: right;
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  }
</style>
@stop

@section('content')

    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>{{ $product->trans_name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->




    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">

            @if(session('msg'))
            <div class="alert alert-success">
                {{session('msg')}}
            </div>
            @endif

            <div class="row">
                <div class="col-lg-7">
                <div class="left-images">
                    <img src="{{ asset('images/'.$product->image->path) }}" alt="">
                    @if ($product->gallery)
                    @foreach ($product->gallery as $img)
                        <img src="{{ asset('images/'.$img->path) }}" alt="">
                    @endforeach
                    @endif

                </div>
            </div>
            <div class="col-lg-5">
                <div class="right-content">
                    <h4>{{ $product->trans_name }}</h4>

                    <span class="price" data-price="{{ $product->price }}">${{ $product->price }}</span>

                    <span>{{ $product->trans_description }}</span>

                    <div class="total">
                        <h4>Total: $<b class="final">{{ $product->price }}</b> </h4>

                        <form action="{{route('front.add_to_cart')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="user_id" value="{{ Auth::id()}}">


                    <div class="quantity-content">
                        <div class="right-content mb-3">
                            <h6>No. of Orders</h6>
                            <div class="quantity buttons_added">
                                <input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" class="plus">
                            </div>
                        </div>
                        <div class="right-content">

                        </div>
                    </div>
                        @auth
                        <div class="main-border-button">
                            <button class="btn btn-dark mt-20" href="#">Add To Cart</button>
                        </div>
                        @endauth

                        </form>

                    </div>

                                <!-------------------Review------------------>

                            @auth

                            <form action="{{ route('front.store', $product->id) }}" method="POST" style="margin-top:40px">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">


                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="10" /><label class="full" for=z`"star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4half" name="rating" value="9" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="8" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3half" name="rating" value="7" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="6" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2half" name="rating" value="5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="4" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1half" name="rating" value="3" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="2" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                    <input type="radio" id="starhalf" name="rating" value="1" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                </fieldset>

                                <textarea class="form-control" placeholder="Review here" name="comment"></textarea>

                                <button class="btn btn-dark mt-2">Review</button>

                                @error('comment')
                                    <small style="color: red;font-size:12px">{{$message}}</small>
                                @enderror
                            </form>

                            @endauth

                </div>
                <div class="container mt-5">
                    <h3 class="mb-4">Customer Reviews</h3>

                    <!-- عرض آخر تقييم فقط إذا كان موجودًا -->
                    @if ($product->reviews->last())
                        <div class="review-card my-2 p-3 border rounded shadow-sm" id="last-review" style="transition: all 0.3s ease;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0" style="font-size: 16px; font-weight: bold; color: #333;">
                                    {{ $product->reviews->last()->user->name ?? 'Anonymous' }}
                                </h5>
                                <span class="text-muted" style="font-size: 12px; color: #777;">
                                    {{ \Carbon\Carbon::parse($product->reviews->last()->created_at)->format('d M, Y') }}
                                </span>
                            </div>
                            <div class="stars mt-2">
                                <span class="text-warning" style="font-size: 14px;">
                                    @for ($i = 0; $i < $product->reviews->last()->star / 2; $i++)
                                        &#9733; <!-- star icon -->
                                    @endfor
                                    @for ($i = 0; $i < (5 - $product->reviews->last()->star / 2); $i++)
                                        &#9734; <!-- empty star -->
                                    @endfor
                                </span>
                            </div>

                            <p class="mt-2" style="font-size: 14px; color: #555;">
                                {{ $product->reviews->last()->comment }}
                            </p>
                        </div>
                    @else
                        <p class="text-muted">No reviews yet. Be the first to review this product!</p>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
@endsection

@section('js')
<script>
    $('.buttons_added .minus').click(function() {
        var quantity = parseInt($(this).parent().find('.qty').val());
        if (quantity > 1){
            $(this).parent().find('.qty').val(--quantity);
        }

        updateTotal()
    })

    $('.buttons_added .plus').click(function() {
        var quantity = parseInt($(this).parent().find('.qty').val());
        $(this).parent().find('.qty').val(++quantity);

        updateTotal()
    })

    function updateTotal() {
        let price = $('span.price').data('price')
        var quantity = parseInt($('.qty').val());
        $('.final').text( price * quantity )
    }


    function toggleReviews() {
        var moreReviews = document.getElementById('more-reviews');
        var button = document.getElementById('toggle-reviews');

        if (moreReviews.style.display === 'none') {
            moreReviews.style.display = 'block';
            button.textContent = 'Show Less Reviews'; // تغيير النص للزر
        } else {
            moreReviews.style.display = 'none';
            button.textContent = 'Show All Reviews'; // تغيير النص للزر
        }
    }
</script>
@endsection

