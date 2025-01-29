<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = [];

        // foreach(Product::all() as $product) {
        //     $products[] = [
        //         "name" => $product->trans_name,
        //         "price" => $product->trans_description
        //     ];
        // }

        // return Product::all();


        return [
            'status' => true,
            'message' => 'All Products',
            'products' => ProductResource::collection(Product::all()) //php artisan make::resources
        ];

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required',
            'gallery' => 'required',
            'price' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
        ]);

        // $data = $request->except('_token', 'image', 'gallery');

        $product = Product::create([
            'name' => '',
            'description' => '',
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // Add image to relation
        $img_name = rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $img_name);
        $product->image()->create([
            'path' => $img_name,
        ]);

        foreach($request->gallery as $img) {
            $img_name = rand().time().$img->getClientOriginalName();
            $img->move(public_path('images'), $img_name);
            $product->image()->create([
                'path' => $img_name,
                'type' => 'gallery'
            ]);
        }

        return response()->json([
            'status' => 'true',
            'message' => 'New Product added',
            'product' => new ProductResource($product)
        ], 201);

        // return redirect()
        // ->route('admin.products.index')
        // ->with('msg', 'Product added successfully')
        // ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if($product) {
            return response()->json([
                'status' => 'true',
                'message' => 'Product found',
                'product' => new ProductResource($product)
            ]);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'Not Found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
