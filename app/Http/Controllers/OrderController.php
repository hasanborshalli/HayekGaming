<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addCart(Request $request,$check=false)
    {
        
        
        $fields=$request->validate([
            'id'=>['required','int','exists:products,id'],
            'quantity'=>['required','int','min:1']
        ]);
        $itemId=$fields['id'];
        $quantity=$fields['quantity'];
        $cart=session('cart_items', []);
        $itemFound=false;
        foreach ($cart as $key => $item) {
            if ($item['id'] == $itemId) {
                $itemFound = true;
                $cart[$key]['quantity'] += $quantity;
            }
        }
        if(!$itemFound) {
            $cart[]=['id'=>$itemId,'quantity'=>$quantity];
        }
        session(['cart_items' => $cart]);
        if($check){
                $orderedItems[] = [
                    'item_id' => $itemId,
                    'quantity' => $quantity,
                ];
                session()->put('ordered_items', $orderedItems);
                        return redirect('/checkout');

        }else{
            if($itemFound) {
            return response()->json(['status'=>"addedOld"]);

        } elseif(!$itemFound) {
            return response()->json(['status'=>"addedNew"]);

        } else {
            return response()->json(['status'=>"failed"]);

        }
        }
        
    }

public function remove(Request $request)
{
    $id = $request->input('id');

    if (!$id) {
        return response()->json(['status' => 'error', 'message' => 'Missing product ID'], 400);
    }

    $cart = session()->get('cart_items', []);

    // Check if the item exists
    $exists = false;
    $newCart = [];

    $itemFound=false;
        foreach ($cart as  $item) {
            if ($item['id'] == $id) {
                $itemFound = true;
                continue;
            }
             $newCart[] = $item;
        }
        if(!$itemFound) {
        return response()->json(['status' => 'error', 'message' => 'Item not found in cart'], 404);
        }


    // Update session
    session(['cart_items' => $newCart]);

    return response()->json(['status' => 'success', 'message' => 'Item removed']);
}



    public function checkout(Request $request)
    {
        $orderedItems = []; // Initialize an array to store ordered items
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'item_') === 0) { // Check for inputs starting with 'item_' to identify items
                $itemId = $value;
                $quantity = $request->input('quantity_' . $itemId);
                // Store item details in the orderedItems array
                $orderedItems[] = [
                    'item_id' => $itemId,
                    'quantity' => $quantity,
                ];
            }
        }
        // Store the ordered items in the session
        session()->put('ordered_items', $orderedItems);
        return redirect('/checkout');
    }
    public function order(Request $request)
{
    $fields = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'mobile' => ['required', 'string'],
        'second_mobile' => [ 'string'],
        'city' => ['required', 'string', 'max:255'],
        'street' => ['required', 'string', 'max:255'],
        'building' => ['nullable', 'string', 'max:255'],
        'floor' => ['nullable', 'string', 'max:255'],
        'remarks' => ['nullable', 'string'],
    ]);

    $items = session()->get('ordered_items');
    $totalPrice = 0;

    foreach ($items as $orderedItem) {
        $itemId = $orderedItem['item_id'];
        $quantity = $orderedItem['quantity'];

        $item = Product::find($itemId);

        if ($item) {
            $itemPrice = $item->sale !== null ? $item->sale : $item->price;
            $totalPrice += $itemPrice * $quantity;
        }
    }

    if ($totalPrice <= 0) {
        return redirect('/cart');
    } else {
        $fields['total'] = $totalPrice;
        $order = Order::create($fields);

        foreach ($items as $orderedItem) {
            DB::table('order_items')->insert([
                'product_id' => $orderedItem['item_id'],
                'order_id' => $order->id,
                'quantity' => $orderedItem['quantity'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        session()->forget('ordered_items');
        session()->forget('cart_items');

        return redirect('thankyou?orderNumber=' . $order->id);
    }
}

    public function DeleteOrder(order $order)
    {
        if($order->delete()) {
            return response()->json(['status'=>"removed"]);

        } else {
            return response()->json(['status'=>"failed"]);

        }
    }
    public function FinishOrder(order $order)
    {
        $order->done=true;
        $order->save();
        return redirect('/admin/orders');
    }
    public function EditOrder(Request $request, order $order)
    {
        $fields=$request->validate([
            'name' => [ 'string', 'max:255'],
            'mobile' => [ 'string'],
            'second_mobile' => [ 'string'],
            'city' => [ 'string', 'max:255'],
            'street' => [ 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'floor' => ['nullable', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
        ]);
        $order->update($fields);
        $totalPrice=0;
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'item_') === 0) { // Check for inputs starting with 'item_' to identify items
                $itemId = $value;
                $product=Product::find($itemId);
                $quantity = $request->input('quantity_' . $itemId);
                DB::table('order_items')
            ->where('order_id', $order->id)
            ->where('product_id', $itemId)
            ->update([
                'quantity' => $quantity,
                'updated_at' => Carbon::now(),
            ]);
                $totalPrice+=$quantity*$product->price;

            }
            
        }
        $order->total=$totalPrice;
        $order->save();
        return redirect('/admin/orders')->with('message', 'Order Edited Successfully');
    }
}