<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="p-2">

        @include('components.transaction-modal', [
            'action' => route('transactions.store'),
            'mode' => 'add',
            'transactionId' => null,
            'name' => '',
            'value' => '',
            'category' => 'fixa',
            'submitButton' => 'Submit'
        ])


        <button id="openModalBtn" type="button" class="inline-flex items-center my-5 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" onclick="openTransactionModal('add')">
            Add Transaction
        </button>
        <div class="flex">
        @include('components.transaction-table', ['transactions' => $transactions])

        @include('components.sum-transaction')
        </div>
    </div>
</x-app-layout>

<script>
    function openTransactionModal(mode, id = null, name = '', value = '', category = '') {

    const modalTitle = document.getElementById('transactionModalTitle');
    const submitBtn = document.getElementById('submitTransactionBtn');
    const form = document.getElementById('transactionForm');
    
    if (mode == 'add') {
        modalTitle.innerText = 'Add Transaction';
        submitBtn.innerText = 'Submit';
        form.action = `{{ route('transactions.store') }}`;
        form.reset();
    } else if (mode == 'edit') {
        modalTitle.innerText = 'Edit Transaction';
        submitBtn.innerText = 'Update';
        form.action = "{{ url('transactions') }}/" + id;
        document.getElementById('transactionId').value = id;
        document.getElementById('description').value = name;
        document.getElementById('amount').value = value;
        document.getElementById('category').value = category;
    }

    transactionModal.classList.remove('hidden');
  }

    function closeModal() {
        document.getElementById('transactionModal').classList.add('hidden');
    }

    
</script>
