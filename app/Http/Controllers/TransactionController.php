<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;



class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions', ['transactions' => $transactions]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required | string',
            'value' => 'required | numeric',
            'category' => 'required | string',
        ]);
        
        $transaction = new Transaction();
        $transaction->name = $validatedData['name'];
        $transaction->value = $validatedData['value'];
        $transaction->category = $validatedData['category'];
        $transaction->user_id = Auth::id();


        $transaction->save();

        return redirect()->route('transactions')->with('success', 'Transaction created successfully!');
    }


    public function destroy (string $id) {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('transactions')->with('success', 'Transaction deleted successfully!');
    }
}


