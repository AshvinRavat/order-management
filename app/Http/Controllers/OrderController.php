<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index()
    {
       $orders = Order::with([
            'customer',
        ])
        ->withCount('products')
        ->paginate(10);

        return view('order.index', [
            'orders' => $orders
        ]);
    }

    public function create()
    {
        return view('order.create', [
            'customers' => Customer::pluck('name', 'id')
        ]);  
    }

   public function store(OrderRequest $request)
    {
        
        \DB::beginTransaction();
        
        try {
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'grand_total' => array_sum(array_column($request->input('product-items'), 'total')), // Calculate total for the order
            ]);
            
            foreach ($request->input('product-items') as $productItem) {
                Product::create([
                    'order_id' => $order->id, 
                    'name' => $productItem['name'],
                    'price' => $productItem['price'],
                    'quantity' => $productItem['quantity'],
                    'total' => $productItem['total'],
                ]);
            }

            \DB::commit();

            return redirect()->route('order.index')->with('success', 'Order created successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while processing the order. Please try again.']);
        }
    }

    public function delete(Order $order)
    {
        $order->delete();

        return to_route('order.index')->with('message', 'order deleted successfully');
    }

}
