<table class="table-auto w-2/3 border-2 ">
    <thead class="bg-cyan-300">
        <tr class="gap-x-1">

            <th class="table-header border">Description</th>
            <th class="table-header border">Amount</th>
            <th class="table-header border">Category</th>
            <th class="table-header border">Date</th>
            <th class="table-header border">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach ($transactions as $transaction)
        <tr class="text-center border hover:bg-amber-100">

            <td class="border">{{ $transaction->name }}</td>
            <td class="border">{{ $transaction->value }}</td>
            <td class="border">{{ $transaction->category }}</td>
            <td class="border">{{ $transaction->updated_at }}</td>
            <td class="border flex px-2 justify-center">
                <button class="font-semibold text-cyan-400 hover:text-cyan-900 px-1" onclick="openTransactionModal('edit', '{{ $transaction->id }}', '{{ $transaction->name }}', '{{ $transaction->value }}', '{{ $transaction->category }}')">EDIT</button>
                | 
                <form class="px-1" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="font-semibold text-rose-400 hover:text-rose-900">DELETE</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>