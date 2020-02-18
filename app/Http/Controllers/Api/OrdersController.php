<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\OrderService;

use Auth;

class OrdersController extends Controller 
{
  public function __construct() 
  {
    $this->middleware('auth.api');
  }

  public function create(Request $request, OrderService $orderService)
  {
    $data = $request->all();

    $user = Auth::user();

    $order = $orderService->create($data, $user);

    return response()->json($order, 200);
  }

  public function add($id, Request $request, OrderService $orderService)
  {
    // fetch the order 
    $order = $orderService->get($id);

    // fetch the data 
    $data = $request->all();

    // remove the item
    $orderService->addItem($order, $data);

    return response()->json([
      'order' => $order,
      'items' => $order->items->load('meal')
    ], 200);
  }

  public function remove($id, Request $request, OrderService $orderService)
  {
    // fetch the order 
    $order = $orderService->get($id);

    // fetch the data 
    $data = $request->all();

    // remove the item 
    $orderService->removeItem($order, $data);

    return response()->json([
      'order' => $order,
      'items' => $order->items->load('meal')
    ], 200);
  }

  public function finish($id, Request $request, OrderService $orderService)
  {
    $order = $orderService->finish();

    return response()->json($order, 200);
  }

  public function quantity($id, Request $request, OrderService $orderService)
  {
    // initilize order
    $order = $orderService->get($id);

    // fetch thedata
    $data = $request->all();

    return response()->json([
        "quantity" => $order->items()->where('meals_id', $data['meal_id'])->first()->quantity
    ], 200);
  }

  public function readyToPay(Request $request, OrderService $orderService)
  {
    // fetch the id 
    $id = $request->get('order');

    // fidn the order 
    $order = $orderService->get($id);

    // set the order status to ready to pay
    $orderService->readyToPay($order);
    
    return response()->json([], 200);
  }

  public function list(OrderService $orderService)
  {
    $list = $orderService->list();

    return response()->json($list, 200);
  }

  public function listAwaitingPayment(OrderService $orderService)
  {
    $list = $orderService->listAwaitingPayment();

    return response()->json($list, 200);
  }

  public function current($id, Request $request, OrderService $orderService)
  {
    // fetch the order
    $order = $orderService->get($id);

    // return the order as presonse 
    return response()->json([
      'order' => $order,
      'order_items' => $order->items->load('meal')
    ], 200);
  }

  public function queue(Request $request, OrderService $orderService)
  {
    // get the data 
    $id = $request->get('order');

    // fetch the order 
    $order = $orderService->get($id);

    // set the order to queued 
    $orderService->queue($order);

    return response()->json($order, 200);
  }

  public function await(Request $request, OrderService $orderService)
  {
    $id = $request->get('order');

    $order = $orderService->get($id);
    $ready = $orderService->await($order);

    return response()->json([
      'ready' => $ready
    ], 200);
  }

  public function awaitPayment(Request $request, OrderService $orderService)
  {
    $id = $request->get('order');

    $order = $orderService->get($id);
    $ready = $orderService->awaitPayment($order);

    return response()->json([
      'ready' => $ready
    ], 200);
  }

  public function unfinishedOrders(Request $request, OrderService $orderService)
  {
    // fetch the user
    $user = Auth::user();

    // fetch the orders
    $orders = $orderService->unfinished($user);

    return response()->json($orders, 200);
  }

  public function active(Request $request, OrderService $orderService)
  {
    // initilize user
    $user = Auth::user();

    // fetch the orders 
    $orders = $orderService->active($user);

    return response()->json($orders, 200);
  }
}
