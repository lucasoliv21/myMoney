<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="p-2">
        <!-- Incluindo o componente do modal -->
        @include('components.transaction-modal', [
            'action' => route('transactions.store'),
            'mode' => 'add',
            'transactionId' => null,
            'name' => '',
            'value' => '',
            'category' => 'fixa',
            'submitButton' => 'Submit'
        ])

        <!-- Botão para abrir o modal de adicionar transação -->
        <button id="openModalBtn" type="button" class="inline-flex items-center my-5 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="openTransactionModal('add')">
            Add Transaction
        </button>
        <div class="flex">
        <!-- Incluindo o componente da tabela -->
        @include('components.transaction-table', ['transactions' => $transactions])

        @include('components.sum-transaction')
        </div>
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
