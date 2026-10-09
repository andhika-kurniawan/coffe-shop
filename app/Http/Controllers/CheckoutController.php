<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'subtotal' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'delivery_info' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $orderCode = 'ORD-'.date('Ymd').'-'.str_pad(
                Order::whereDate('created_at', today())->count() + 1,
                3,
                '0',
                STR_PAD_LEFT
            );

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_code' => $orderCode,
                'status' => 'pending',
                'subtotal' => $validated['subtotal'],
                'tax' => 0,
                'total' => $validated['total'],
                'notes' => $validated['notes'] ?? null,
                'delivery_info' => $validated['delivery_info'] ?? null,
            ]);

            foreach ($validated['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'selected_options' => json_encode($item['options'] ?? []),
                ]);
            }

            DB::commit();

            $message = "Halo, saya ingin konfirmasi pesanan:\n\n";
            $message .= "Order ID: {$orderCode}\n";
            $message .= 'Total: Rp '.number_format($order->total, 0, ',', '.')."\n\n";
            $message .= 'Link detail: '.route('orders.show', $order->id);

            $waUrl = 'https://wa.me/'.env('WHATSAPP_NUMBER', '62812345678').'?text='.urlencode($message);

            session()->put('cart', []);

            return redirect()->away($waUrl);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal membuat order. Silakan coba lagi.']);
        }
    }
}
