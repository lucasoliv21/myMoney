<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    <div class=" p-2" >
      <button id="openModalBtn" type="button" class="inline-flex items-center my-5 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Add Transaction
      </button>
      <div id="transactionModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
        <div class="fixed inset-0 bg-gray-500  bg-opacity-50 "></div>
            <div class="relative  p-10 bg-white rounded-lg shadow-xl">
                <!-- Conteúdo do modal -->
                <h2 class="text-xl font-semibold mb-4">Add Transaction</h2>
                <form id="addTransactionForm" method="POST" action="{{ route('transactions.store') }}">
                    @csrf
                    <!-- Campos do formulário -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descrição:</label>
                        <input type="text" name="description" id="description" class="border-2 rounded border-gray-300 p-2 w-full">
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Valor:</label>
                        <input type="number" name="amount" id="amount" class="border-2 rounded border-gray-300 p-2 w-full">
                    </div>
                    <div class="mb-2">
                      <label for="category">Categoria: </label>
                      <select name="category" class="rounded">
                        <option value="fixa">Fixa</option>
                        <option value="variavel">Variável</option>
                        <option value="investimento">Investimento</option>
                      </select>
                    </div>
                    <div class="flex justify-between mt-10">
                      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
      <table class="table-auto w-2/3 border ">
        <thead>
          <tr class="gap-x-1">
            <th class="table-header border">ID</th>
            <th class="table-header border">Description</th>
            <th class="table-header border">Amount</th>
            <th class="table-header border">Category</th>
            <th class="table-header border">Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transactions as $transaction)
            <tr>
              <td>{{ $transaction->id }}</td>
              <td>{{ $transaction->description }}</td>
              <td>{{ $transaction->amount }}</td>
              <td>{{ $transaction->category }}</td>
              <td>{{ $transaction->date }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</x-app-layout>

<script>
    // Encontrar o botão "Add Transaction"
    const openModalBtn = document.getElementById('openModalBtn');
    // Encontrar o modal
    const transactionModal = document.getElementById('transactionModal');

    // Adicionar um evento de clique ao botão "Add Transaction"
    openModalBtn.addEventListener('click', function() {
        // Mostrar o modal ao clicar no botão
        transactionModal.classList.remove('hidden');
    });

    // Função para fechar o modal
    function closeModal() {
        transactionModal.classList.add('hidden');
    }
</script>
