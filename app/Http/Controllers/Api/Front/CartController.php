<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Front\Project\AddToCartRequest;
use App\Services\Front\CartService;
use App\Http\Traits\Response;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use Response;
   
    public function __construct(private CartService $cartService) {
    }
    public function addToCart(Request $request, $productId)
    {
        return $this->cartService->addToCart($request, $productId);
        
    }

    public function removefromcart($productId)
    {

        $data = $this->cartService->removefromcart($productId); 
        return $this->responseApi(__('product delete successfully'), $data); 
    }

  

    public function getCart()
{
    
        $cart = $this->cartService->getCart();

        return $this->responseApi(__('Cart retrieved successfully!'), $cart);
    
}

    
    
}
