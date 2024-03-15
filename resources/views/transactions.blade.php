<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    <div class="p-2">
        <button id="openModalBtn" type="button" class="inline-flex items-center my-5 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="openTransactionModal('add')">
            Add Transaction
        </button>
        <div id="transactionModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-50 "></div>
                <div class="relative p-10 bg-white rounded-lg shadow-xl">
                    <h2 id="transactionModalTitle" class="text-xl font-semibold mb-4">Transaction</h2>
                    <form id="transactionForm" method="POST" action="" enctype="multipart/form-data">
                      @csrf
                      @method('POST') 
                      <!-- Adicione um campo oculto para o ID da transação -->
                      <input type="hidden" name="id" id="transactionId">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Descrição:</label>
                            <input type="text" name="name" id="description" class="border-2 rounded border-gray-300 p-2 w-full">
                        </div>
                        <div class="mb-4">
                            <label for="value" class="block text-gray-700 text-sm font-bold mb-2">Valor:</label>
                            <input type="number" name="value" id="amount" class="border-2 rounded border-gray-300 p-2 w-full">
                        </div>
                        <div class="mb-2">
                            <label for="category">Categoria: </label>
                            <select name="category" id="category" class="rounded">
                                <option value="fixa">Fixa</option>
                                <option value="variavel">Variável</option>
                                <option value="investimento">Investimento</option>
                            </select>
                        </div>
                        <div class="flex justify-between mt-10">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="submitTransactionBtn">
                                Submit
                            </button>
                            <button type="button" class="bg-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 rounded mr-2" onclick="closeModal()">
                                Cancel
                            </button>
                        </div>
                    </form>
                    <!-- Fim do conteúdo do modal -->
                </div>
            </div>
        </div>
        <table class="table-auto w-2/3 border-2 ">
            <thead class="bg-cyan-300">
                <tr class="gap-x-1">
                    <th class="table-header border">ID</th>
                    <th class="table-header border">Description</th>
                    <th class="table-header border">Amount</th>
                    <th class="table-header border">Category</th>
                    <th class="table-header border">Date</th>
                    <th class="table-header border">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($transactions as $transaction)
                <tr class="text-center border">
                    <td class="border">{{ $transaction->id }}</td>
                    <td class="border">{{ $transaction->name }}</td>
                    <td class="border">{{ $transaction->value }}</td>
                    <td class="border">{{ $transaction->category }}</td>
                    <td class="border">{{ $transaction->updated_at }}</td>
                    <td class="border flex px-2 justify-center">
                        <button class="text-cyan-500 hover:text-cyan-900" onclick="openTransactionModal('edit', '{{ $transaction->id }}', '{{ $transaction->name }}', '{{ $transaction->value }}', '{{ $transaction->category }}')">Edit</button>
                        | 
                        <form class="px-1" action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-900">DELETE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<script>
    // Encontrar o botão "Add Transaction"
    function openTransactionModal(mode, id = null, name = '', value = '', category = '') {
    // Obter o título do modal e o botão de envio
    const modalTitle = document.getElementById('transactionModalTitle');
    const submitBtn = document.getElementById('submitTransactionBtn');
    const form = document.getElementById('transactionForm');
    
    // Determinar o modo (adicionar ou editar) e ajustar o título e o texto do botão de envio
    if (mode == 'add') {
        modalTitle.innerText = 'Add Transaction';
        submitBtn.innerText = 'Submit';
        // Definir a ação do formulário para adicionar uma nova transação
        form.action = `{{ route('transactions.store') }}`;
        // Limpar os campos do formulário
        form.reset();
    } else if (mode == 'edit') {
        modalTitle.innerText = 'Edit Transaction';
        submitBtn.innerText = 'Update';
        // Definir a ação do formulário para editar a transação existente
        form.action = "{{ url('transactions') }}/" + id;
        // Preencher os campos do formulário com os dados da transação existente
        document.getElementById('transactionId').value = id;
        document.getElementById('description').value = name;
        document.getElementById('amount').value = value;
        document.getElementById('category').value = category;
    }

    // Mostrar o modal
    transactionModal.classList.remove('hidden');
  }

    function closeModal() {
        document.getElementById('transactionModal').classList.add('hidden');
    }

    
</script>
