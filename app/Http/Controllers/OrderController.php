<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function index()
    // {
    //     $transactions = Transaction::where('user_id', Auth::id())->get();
    //     return view('user.order.index', compact('transactions'));
    // }
    public function index()
    {
        // Check if the authenticated user is an admin
        if (Auth::user()->role === 'admin') {
            // Get all transactions for admin in descending order
            $transactions = Transaction::with('product', 'user')
                ->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.orders.index', compact('transactions'));
        } elseif (Auth::user()->role === 'user') {
            // Get only the user's transactions for regular users in descending order
            $transactions = Transaction::where('user_id', Auth::id())
                ->with('product')
                ->orderBy('created_at', 'desc')
                ->get();
            return view('user.order.index', compact('transactions'));
        }

        // Optionally handle other roles or default case
        return redirect()->route('forbidden');
    }

    public function create()
    {
        // Handle the creation of new orders
        $users = User::all();
        $products = Product::all();
        return view('admin.orders.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        Transaction::create($request->all());
        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully');
    }

    public function show($id)
    {
        $transaction = Transaction::with('product', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $users = User::all();
        $products = Product::all();
        return view('admin.orders.edit', compact('transaction', 'users', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }
}