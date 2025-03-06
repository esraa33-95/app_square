<?php

namespace App\Services\Front;

use App\Http\Traits\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;



class OrderService
{

    use Response;

    public function createOrder(Request $request, $userId)
    {
       
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1'
        ]);

       
        $user = User::findOrFail($userId);

        $order = $user->orders()->create([
            'status' => 'pending'
        ]);

        $totalPrice = 0;
        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['id']);
            $quantity = $productData['quantity'];
            $totalPrice += $product->price * $quantity;

            $order->products()->attach($product->id, ['quantity' => $quantity]);
        }

        return response()->json([
            'message' => 'Order created successfully!',
            'order_id' => $order->id,
            'total_price' => $totalPrice
        ], 201);
    }




}