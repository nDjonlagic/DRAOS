<?php

namespace App\Services;

use App\Order;
use App\OrderItem;
use App\OrderStatus;

use DB;

class OrderService 
{
  protected $statusSelecting;
  protected $statusReadyToPay;
  protected $statusQueued;
  protected $statusPreparing;
  protected $statusReady;

  public function __construct()
  {
    $this->statusSelecting = OrderStatus::where('title', 'Selecting items')->first();
    $this->statusReadyToPay = OrderStatus::where('title', 'Ready to pay')->first();
    $this->statusQueued = OrderStatus::where('title', 'Queueud for preparation')->first();
    $this->statusPreparing = OrderStatus::where('title', 'Preparing order')->first();
    $this->statusReady = OrderStatus::where('title', 'Order ready')->first();
  }

  public function get($id)
  {
    return Order::findOrFail($id);
  }

  public function create($data, $user)
  {
    $status = $this->statusSelecting;

    return Order::create($data + [
      'status_id' => $status->id,
      'users_id' => $user->id
    ]);
  }

  public function addItem($order, $data)
  {
    // check if order item exists 
    $exists = $order->items()
                   ->where('meals_id', $data['meal_id'])
                   ->exists();

    if(!$exists) {
      $order->items()
            ->create([
              'meals_id' => $data['meal_id'],
              'quantity' => 1
            ]);
    } else {
      $order->items()
            ->where('meals_id', $data['meal_id'])
            ->increment('quantity');
    }
  }

  public function removeItem($order, $data)
  {
    // check if order item exists and fetch items
    $exists = $order->items()
                   ->where('meals_id', $data['meal_id'])
                   ->exists();

    $items = $order->items()
                   ->where('meals_id', $data['meal_id'])
                   ->first();

    if($exists) {
      if($items->quantity == 1) {
        $order->items()
              ->where('meals_id', $data['meal_id'])
              ->delete();
      } else {
        $order->items()
              ->where('meals_id', $data['meal_id'])
              ->decrement('quantity');
      }
    }
  }

  public function list()
  {
    // fetch th estatus
    $status = $this->statusQueued;

    // rturn theorders
    return Order::where('status_id', $status->id)
                  ->orderBy('updated_at', 'ASC')
                  ->with('status')
                  ->paginate(10);
  }

  public function listAwaitingPayment()
  {
    // fetch th estatus
    $status = $this->statusReadyToPay;

    // rturn theorders
    return Order::where('status_id', $status->id)
                  ->orderBy('updated_at', 'ASC')
                  ->with('status')
                  ->paginate(10);
  }

  /**
   * Find the next order in the queue for preparatin
   *
   */
  public function next()
  {
    $status = $this->statusQueued;

    return Order::where('status_id', $status->id)
                  ->orderBy('updated_at', 'ASC')
                  ->first();
  }

  /**
   * Take order for preapration
   * 
   * @param Integer $id 
   */
  public function take($order, $user)
  {
    $status = $this->statusPreparing;

    $order->status_id = $status->id;
    $order->staff_id = $user->id;
    $order->save();
  }

  /**
   * Finish a specfic order 
   *
   */
  public function finish($order)
  {
    $status = $this->statusReady;

    $order->status_id = $status->id;
    $order->save();
  }

  /**
   * Set the order into the queueue
   *
   * 
   */
  public function queue($order)
  {
    // fetch the status 
    $status = $this->statusQueued;

    // set the order status
    $order->status_id = $status->id;
    $order->save();
  }

  /**
   * Set the order sttus to ready to pay
   *
   */
  public function readyToPay($order)
  {
    // fetch the status 
    $status = $this->statusReadyToPay;

    // set the order status
    $order->status_id = $status->id;
    $order->save();
  }

  /**
   * Await the order 
   *
   *
   */
  public function await($order)
  {
    $status = $this->statusReady;

    if($status->id == $order->status_id) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Await payment 
   *
   *
   */
  public function awaitPayment($order)
  {
    $status = $this->statusQueued;

    if($status->id == $order->status_id) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Unfinihes orders for a specific user 
   *
   * 
   */
  public function unfinished($user, $paginate = 5)
  {
    // initilize status 
    $status = $this->statusSelecting;

    // fetch the latest 5 unfinished orders 
    $orders = Order::select(DB::raw('orders.*, COUNT(order_items.id) as num'))
                    ->leftJoin('order_items', 'order_items.orders_id', '=', 'orders.id')
                    ->where('orders.users_id', $user->id)
                    ->where('orders.status_id', $status->id)
                    ->groupBy('orders.id')
                    ->havingRaw('COUNT(order_items.id) > 0')
                    ->latest()
                    ->paginate(5);

    $data = [];

    foreach($orders as $key => $item) {
      $data[$key]['order'] = $item;
      $data[$key]['order_items'] = $item->items->load('meal');
    }

    return $data;
  }

  /**
   * List of active orders 
   *
   *
   */
  public function active($user) 
  {
    // initilize the status
    $status = $this->statusPreparing;

    return Order::where('status_id', $status->id)
                  ->where('staff_id', $user->id)
                  ->get();
  }
}