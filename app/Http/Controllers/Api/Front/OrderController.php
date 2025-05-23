<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Traits\Response;
use App\Services\Front\OrderService;

class OrderController extends Controller
{
    use Response;
    
    /**
     * Display a listing of the resource.
     */

     public function __construct(private OrderService $orderService) {
    }
    public function createOrder(Request $request, $userId)
    {
        $data = $this->orderService->createOrder($request, $userId);
        return $this->responseApi(__('order create successfully'), $data);

    }

    public function cancelOrder($id)
    {

        $data = $this->orderService->cancelOrder($id);
        return $this->responseApi(__('order delete successfully')); 
        
    }

    public function getUserOrders(Request $request)
    {
       $data =  $this->orderService->getUserOrders($request);
        return $this->responseApi(__('show order successfully'),$data); 

    }



}
