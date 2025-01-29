<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\String\b;

class CartController extends Controller
{
    public function  add_to_cart(Request $request){


        $quantity = $request->input('quantity');
        $product =Product::find($request->product_id);
        $cart =Cart::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();


        if($cart){
            $cart->update(['quantity'=>$cart->quantity + $quantity]);
        }else{
            Cart::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $quantity,
                'price' => $product->sale_price ? $product->sale_price :$product->price,
                'total' =>  $product->sale_price ? $product->sale_price * $quantity : $product->price * $quantity
            ]);
        }



            return redirect()->back()->with('msg','Product add to cart');
    }

    public function cart(){
        return view('front.cart');

    }


    public function cartDelete(Cart $cart){
        $cart->delete();
        return redirect()->back()->with('msg','Product delete from cart');
    }

    public function checkout(){

        $amount=Auth::user()->carts()->sum(DB::raw('quantity * price')); // جملة استعلام داخلية by laravel

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4c79394bdc801939736f17e063d" .
            "&amount=$amount" .
            "&currency=USD" .
            "&paymentType=DB" .
            "&integrity=true";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer OGFjN2E0Yzc5Mzk0YmRjODAxOTM5NzM2ZjFhNzA2NDF8Ulh5az9pd2ZNdXprRVpRYjdFcWs='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
        return curl_error($ch);
        }
        curl_close($ch);
         $responseData = json_decode($responseData,true);
        $id=$responseData['id'];
        return view('front.checkout',compact('id'));
    }

    public function payment(Request $request){

        $resourcePath =$request->resourcePath;
        // dd($request->all());

            $url =env('PaymentUrl').$resourcePath;
            $url .= "?entityId=8ac7a4c79394bdc801939736f17e063d";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Authorization:Bearer OGFjN2E0Yzc5Mzk0YmRjODAxOTM5NzM2ZjFhNzA2NDF8Ulh5az9pd2ZNdXprRVpRYjdFcWs='));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
         $responseData = json_decode($responseData, true);
        //  dd($responseData);

         $code=$responseData['result']['code'];

         if ($code == '100.100.303') {
            $id = $responseData['id'];
            $amount = $responseData['amount'];

            DB::beginTransaction();
            try{


            $order = Order::create([
                'total' => $amount,
                'user_id' => Auth::id(),
            ]);

            foreach (Auth::user()->carts as $cart) {
                OrderDetail::create([
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                    'product_id' => $cart->product_id,
                    'user_id' => $cart->user_id,
                    'order_id' => $order->id,
                    'total' => $cart->price * $cart->quantity,
                ]);

                $cart->product()->decrement('quantity', $cart->quantity);
                $cart->delete();
            }

            Payment::create([
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'total' => $amount,
                'transaction_number' => $id,
                'payment_method' => 'online',
            ]);

            DB::commit();


            }catch(Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
            return redirect()->route('front.payment_success');
        } else {
            return redirect()->route('front.payment_fail');
        }

    }
}
