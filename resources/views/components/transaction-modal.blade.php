<div id="transactionModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 "></div>
        <div class="relative p-10 bg-white rounded-lg shadow-xl">
            <h2 id="transactionModalTitle" class="text-xl font-semibold mb-4">Transactionddddd</h2>
            @php
                $method = 'POST'; // Defina o método padrão como POST
                $action = route('transactions.store'); // Defina a ação padrão como store
                if ($mode === 'edit') {
                    $method = 'PATCH'; // Defina o método como PATCH
                    $action = route('transactions.update', $transaction->id);
                }
            @endphp
            <form id="transactionForm" method="{{ $method }}" action="{{ $action }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="transactionId" value="{{ $transactionId }}">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Descrição:</label>
                    <input type="text" name="name" id="description" class="border-2 rounded border-gray-300 p-2 w-full" value="{{ $name }}">
                </div>
                <div class="mb-4">
                    <label for="value" class="block text-gray-700 text-sm font-bold mb-2">Valor:</label>
                    <input type="number" name="value" id="amount" class="border-2 rounded border-gray-300 p-2 w-full" value="{{ $value }}">
                </div>
                <div class="mb-2">
                    <label for="category">Categoria: </label>
                    <select name="category" id="category" class="rounded">
                        <option value="fixa" {{ $category === 'fixa' ? 'selected' : '' }}>Fixa</option>
                        <option value="variavel" {{ $category === 'variavel' ? 'selected' : '' }}>Variável</option>
                        <option value="investimento" {{ $category === 'investimento' ? 'selected' : '' }}>Investimento</option>
                    </select>
                </div>
                <div class="flex justify-between mt-10">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="submitTransactionBtn">{{ $submitButton }}</button>
                    <button type="button" class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 rounded mr-2" onclick="closeModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
