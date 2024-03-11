<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;



class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions', ['transactions' => $transactions]);
    }
    public function store(Request $request)
    {
        // Valide os dados da requisição, se necessário
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category' => 'required|string',
        ]);

        // Crie a transação
        $transaction = Transaction::create([
            'description' => $validatedData['description'],
            'amount' => $validatedData['amount'],
            'date' => $validatedData['date'],
            'category' => $validatedData['category'],
        ]);
        $transaction->save();

        // Retorne uma resposta adequada, como um JSON com a transação criada
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }
}


