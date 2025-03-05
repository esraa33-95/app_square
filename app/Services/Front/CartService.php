<?php

namespace App\Services\Front;


use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CartService
{

    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user(); 
   
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $product = Product::findOrFail($productId);

        $cartProduct = CartProduct::where('cart_id', $cart->id)
                                  ->where('product_id', $product->id)
                                  ->first();

        if ($cartProduct) {
            
            $cartProduct->increment('quantity', $request->input('quantity', 1));
        } else {
            
            CartProduct::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cart' => $cart->load('products'),
        ]);
    }


    public function removefromcart($productId)
    {
        $cart = Cart::where('user_id', auth('sanctum')->id())?->first();
        $cart ?->products()?->detach($productId);
    }

    public function getCart()
    {
        $userId = auth('sanctum')->id();
    
        if (!$userId) {
            throw new \Exception('Unauthorized', 401);
        }
     
        $cart = Cart::where('user_id', $userId)->with('products')->first();
    
        if (!$cart) {
            throw new \Exception('Cart is empty', 404);
        }
    
        return $cart;
    }

    



}