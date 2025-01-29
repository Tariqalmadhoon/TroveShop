<?php

namespace App\Http\Controllers;
use App\Mail\ContactMail;
use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class FrontController extends Controller
{
    function index() {
        $categories = Category::all();
        return view('front.index', compact('categories'));
    }

    function about() {
        return view('front.about');
    }

    function products() {
        $products = Product::latest('id')->paginate(9);
        return view('front.products', compact('products'));
    }

    function products_single($id) {
        $product = Product::findOrFail($id);
        return view('front.products_single', compact('product'));
    }

    function category($id) {
        $category = Category::findOrFail($id);
        $products = $category->products()->latest('id')->paginate(9);
        return view('front.category', compact('category', 'products'));
    }

    function contact() {
        return view('front.contact');
    }

    public function send(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // إرسال البريد الإلكتروني
        Mail::to('tariqmadhoon@gmail.com')->send(new ContactMail($request->all()));

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }



    public function store(Request $request){
        $request->validate([
            'rating' => 'required',
            'comment' => 'required'
        ],[

            'comment.required' => 'Please write a comment'
        ]);

        Review::create([
            'star' => $request->rating,
            'comment' => $request->comment,
            'product_id' => $request->product_id,
            'user_id' => auth()->id()

        ]);


        return redirect()->back();
    }


    public function search(Request $request){
        $name = app()->currentLocale(); // احصل على اللغة الحالية (en أو ar)
        $products = Product::whereRaw("JSON_EXTRACT(name, '$.$name') LIKE ?", ['%' . $request->keyword . '%'])->get();

        return view('front.search', compact('products'));

    }

    function myProfile(){
        return view('front.profile');
    }


    function profile() {
        $person = Auth::user();
        return view('front.profile', compact('person'));
    }


    public function profile_data(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed'
        ]);

        /** @var User $person */
        $person = Auth::user();

        $data = [
            'name' => $request->name
        ];

        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $person->update($data);

        if ($request->hasFile('image')) {
            if ($person->image) {
                File::delete(public_path('images/' . $person->image->path));
                $person->image()->delete();
            }
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $img_name);
            $person->image()->create([
                'path' => $img_name
            ]);
        }

        // إعادة توجيه مع رسالة نجاح
        return redirect()->route('front.profile')->with('msg', 'Profile updated successfully');
    }


}













