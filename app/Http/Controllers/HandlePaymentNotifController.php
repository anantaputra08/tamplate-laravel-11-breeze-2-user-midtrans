<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HandlePaymentNotifController extends Controller
{
    /**
     * Handle the incoming request.
     */

    // Testing API
    // public function __invoke(Request $request)
    // {
    //     $payload = $request->all();

    //     Log::info('incoming-midtrans', [
    //         'payload' => $payload
    //     ]);

    //     return response()->json(['message' => 'Notification received']);
    // }

    public function __invoke(Request $request)
    {
        $payload = $request->all();

        // dd($payload);

        Log::info('incoming-midtrans', [
            'payload' => $payload
        ]);

        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];

        $reqSignature = $payload['signature_key'];

        $signature = hash('sha512', $orderId . $statusCode . $grossAmount . env('MIDTRANS_SERVER_KEY'));

        if ($reqSignature !== $signature) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid signature'
            ], 401);
        }

        $transactionStatus = $payload['transaction_status'];

        $order = Transaction::find($orderId);
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid order ID'
            ], 400);
        }

        if ($transactionStatus == 'capture') {
            $order->status = 'paid';
            $order->save();
        } else if ($transactionStatus == 'settlement') {
            $order->status = 'paid';
            $order->save();
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $order->status = 'cancelled';
            $order->save();
        } else if ($transactionStatus == 'pending') {
            $order->status = 'pending';
            $order->save();
        }

        return response()->json(['message' => 'success']);
    }
}
