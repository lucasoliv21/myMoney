<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    <div class=" p-2" >
      <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"> Add Transaction</button>
      <table class="table-auto w-full border ">
        <thead>
          <tr class="gap-x-1">
            <th class="border">ID</th>
            <th class="table-header border">Description</th>
            <th class="table-header border">Amount</th>
            <th class="border">Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transactions as $transaction)
            <tr>
              <td>{{ $transaction->id }}</td>
              <td>{{ $transaction->description }}</td>
              <td>{{ $transaction->amount }}</td>
              <td>{{ $transaction->date }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</x-app-layout>
