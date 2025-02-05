<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk Admin
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $pendingOrders = Transaction::where('status', 'pending')->count();
        $processOrders = Transaction::where('status', 'process')->count();
        $completedOrders = Transaction::where('status', 'completed')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'pendingOrders',
            'processOrders',
            'completedOrders'
        ));
    }
}
