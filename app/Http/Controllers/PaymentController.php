<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function checkout($product_id)
    {
        $product = Product::findOrFail($product_id);

        // Check if the product stock is sufficient
        if ($product->stock < 1) {
            return redirect()->back()->withErrors(['error' => 'Insufficient stock for the selected product']);
        }

        // Configure Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Create transaction parameters
        $transaction_details = [
            'order_id' => uniqid(),
            'gross_amount' => $product->price,
        ];

        $item_details = [
            [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
                'name' => $product->name,
            ],
        ];

        $customer_details = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        try {
            $snapResponse = Snap::createTransaction($params);
            $snapToken = $snapResponse->token;

            // dd($snapToken);

            // Save transaction to the database
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'amount' => $product->price,
                'status' => 'pending', // Set initial status to pending
                'snapToken' => $snapToken,
                'order_id' => $transaction_details['order_id'], // Save order ID
            ]);

            $transaction->snapToken = $snapToken;
            $transaction->save();

            // Reduce the stock of the product
            $product->decrement('stock', 1);

            // Redirect to the Snap payment page
            return view('user.payment.checkout', compact('snapToken', 'transaction', 'product'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to process payment: ' . $e->getMessage()]);
        }
    }


    public function paymentSuccess(Request $request)
    {
        // Ambil order_id dari request (sesuaikan dengan parameter yang Anda gunakan)
        $transactionId = $request->input('transaction_id');

        // Temukan transaksi berdasarkan order_id
        $transaction = Transaction::where('id', $transactionId)->first();

        if ($transaction) {
            // Perbarui status transaksi ke 'process'
            $transaction->status = 'process';
            $transaction->save();
        } else {
            // Tangani kasus jika transaksi tidak ditemukan
            return redirect()->back()->withErrors(['error' => 'Transaction not found']);
        }

        // Tampilkan halaman sukses
        return view('user.payment.success');
    }

    public function notificationHandler(Request $request)
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Handle the notification
        $notification = new Notification();
        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;

        // Find the transaction by order_id
        $transaction = Transaction::where('order_id', $orderId)->first();

        if ($transaction) {
            if ($transactionStatus == 'settlement') {
                // Update the status to 'process'
                $transaction->status = 'process';
                $transaction->save();
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function recurringNotificationHandler(Request $request)
    {
        // Handle recurring notification here
        return response()->json(['status' => 'success']);
    }

    public function payAccountNotificationHandler(Request $request)
    {
        // Handle pay account notification here
        return response()->json(['status' => 'success']);
    }

    public function finishRedirect(Request $request)
    {
        return view('user.payment.finish');
    }

    public function unfinishedRedirect(Request $request)
    {
        return view('user.payment.unfinished');
    }

    public function errorRedirect(Request $request)
    {
        return view('user.payment.error');
    }
}