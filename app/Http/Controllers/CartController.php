<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $total= $request->mass * (float)$request->price;
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'mass' => $request->mass,
            'price' => $total
        ]);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('cart', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        foreach ($request->mass as $cartItemId => $newMass) {
            $cartItem = Cart::find($cartItemId);
            $cartItem->mass = $newMass;
            $cartItem->price = $cartItem->product->price * $newMass;
            $cartItem->save();
        }

        return redirect()->route('cart.view')->with('success', 'Cart updated successfully.');
    }
    public function checkout(Request $request)
    {
        $userId = Auth::id();
        $selectedItems = explode(',', $request->input('selected_items_for_checkout'));

        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'No items selected for checkout.');
        }

        $cartItems = Cart::whereIn('id', $selectedItems)->where('user_id', $userId)->get();

        $groupedItems = [];
        foreach ($cartItems as $item) {
            if (!isset($groupedItems[$item->product_id])) {
                $groupedItems[$item->product_id] = [
                    'mass' => 0,
                    'price' => $item->price,
                    'quantity' => 0,
                ];
            }
            $groupedItems[$item->product_id]['mass'] += $item->mass;
            $groupedItems[$item->product_id]['quantity'] += 1;
        }
        foreach ($groupedItems as $productId => $data) {
            Checkout::create([
                'user_id'    => $userId,
                'product_id' => $productId,
                'mass'       => $data['mass'],
                'price'      => $data['price'] * $data['quantity'],
            ]);
        }

        Cart::whereIn('id', $selectedItems)->delete();

        return redirect()->route('home')->with('success', 'Checkout completed successfully.');
    }



    public function delete($id)
    {

        $cartItem = Cart::find($id);

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.view', ['user_id' => Auth::id()])->with('success', 'Product removed from the cart successfully.');
        }

        return redirect()->route('cart.view', ['user_id' => Auth::id()])->with('error', 'Failed to remove the product from the cart.');
    }


}
