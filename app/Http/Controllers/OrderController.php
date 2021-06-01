<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')->paginate();
        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        return OrderResource::make($order->load('orderItems'));
    }

    public function export()
    {
        $headers = [
            'Content-Type'          =>  'text/csv',
            'Content-Disposition'   =>  'attachment; filename=orders.csv',
            'Pragma'                =>  'no-cache',
            'Cache-Control'         =>  'must-revalidate, post-check=0, pre-check=0',
            'Expires'               =>  '0'
        ];

        $callback = function() {
            $orders = Order::all();
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Product Title', 'Price', 'Quantity']);
            foreach ($orders as $order)
            {
                fputcsv($file, [$order->id, $order->name, $order->email, '', '', '']);
                foreach($order->orderItems as $item)
                {
                    fputcsv($file, ['', '', '', $item->product_title, $item->price, $item->quantity]);
                }
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function chart()
    {
        return Order::query()
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->selectRaw("date_format(orders.created_at, '%y-%m-%d') as date, sum(order_items.price * order_items.quantity) as sum")
                    ->groupBy('date')
                    ->get();
    }
}
