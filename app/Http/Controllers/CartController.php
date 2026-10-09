<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function getCart(Request $request)
    {
        $cart = session()->get('cart', []);

        return response()->json($cart);
    }

    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'options' => 'nullable|array',
        ]);

        $cart = session()->get('cart', []);
        $itemId = md5($validated['menu_id'].json_encode($validated['options'] ?? []));

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $validated['quantity'];
        } else {
            $cart[$itemId] = [
                'id' => $itemId,
                'menu_id' => $validated['menu_id'],
                'quantity' => $validated['quantity'],
                'options' => $validated['options'] ?? [],
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function updateQuantity(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$validated['item_id']])) {
            $cart[$validated['item_id']]['quantity'] = $validated['quantity'];
            session()->put('cart', $cart);

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Item not found'], 404);
    }

    public function removeItem(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        unset($cart[$validated['item_id']]);
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function clearCart()
    {
        session()->put('cart', []);

        return response()->json(['success' => true]);
    }
}
