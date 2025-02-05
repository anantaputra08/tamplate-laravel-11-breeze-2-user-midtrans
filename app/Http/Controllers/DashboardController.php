<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hitung jumlah order selesai & belum selesai
        if ($user->role === 'admin') {
            $pendingOrders = Transaction::where('status', 'pending')->count();
            $processOrders = Transaction::where('status', 'process')->count();
            $completedOrders = Transaction::where('status', 'completed')->count();

            return view('admin.dashboard', compact('completedOrders', 'pendingOrders'));
        } else {
            $pendingOrders = Transaction::where('user_id', $user->id)
                ->where('status', 'pending')->count();
            $processOrders = Transaction::where('user_id', $user->id)
                ->where('status', 'process')->count();
            $completedOrders = Transaction::where('user_id', $user->id)
                ->where('status', 'completed')->count();

            return view('user.dashboard', compact('completedOrders', 'pendingOrders', 'processOrders'));
        }

    }
}
