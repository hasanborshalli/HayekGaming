<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addCart(Request $request)
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
        if($itemFound) {
            return response()->json(['status'=>"addedOld"]);

        } elseif(!$itemFound) {
            return response()->json(['status'=>"addedNew"]);

        } else {
            return response()->json(['status'=>"failed"]);

        }
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
            'second_mobile' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'floor' => ['nullable', 'string', 'max:255'],
            'remarks' => ['nullable', 'string'],
        ]);
        $items=session()->get('ordered_items');
        $totalPrice = 0;
        foreach ($items as $orderedItem) {
            $itemId = $orderedItem['item_id'];
            $quantity = $orderedItem['quantity'];
    
            // Get the item from the database (assuming your items are in the Product model)
            $item = Product::find($itemId);
    
            if ($item) {
                // Multiply item price by quantity and add it to the total price
                $totalPrice += $item->price * $quantity;
            }
        }
        if($totalPrice<=0) {
            return redirect('/cart');
        } else {
            // Add the total price to the fields array
            $fields['total'] = $totalPrice;
            $order=Order::create($fields);
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
            $orderNumber=$order->id;
            return redirect('thankyou?orderNumber=' . $orderNumber);

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