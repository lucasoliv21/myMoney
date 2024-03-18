<div class="px-2 w-1/6 ">
  <div class=" bg-slate-200 p-2 border-2 border-black ">
    <h1 class="text-center font-bold ">Total de gastos</h1>
    <p class="text-center font-bold text-rose-400 text-2xl">{{ $transactions->sum('value') }}</p>
  </div>
</div>