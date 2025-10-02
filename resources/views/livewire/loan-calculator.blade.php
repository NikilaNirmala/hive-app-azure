<div>
    <div class="max-w-xl mx-auto text-center mt-10 mb-10">
        <h2 class="text-3xl text-[#333333] font-extrabold">Loan Calculator</h2>
    </div>

    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg p-6 mb-[100px]">
        <div class="grid grid-cols-2 gap-4 mb-6">
            <!-- Loan amount input -->
            <div>
                <label class="block text-gray-700 text-sm font-semibold">Loan amount</label>
                <input type="number" wire:model="loanAmount" placeholder="Loan amount"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg bg-purple-50" min="0"
                    step="any" />
            </div>

            <!-- Eligible amount display -->
            <div class="flex flex-col justify-end items-end">
                <label class="block text-gray-700 text-sm font-semibold">Total amount</label>
                <h2 class="text-[22px] font-semibold text-gray-800 mt-1">Rs: {{ number_format($eligibleAmount, 2) }}
                </h2>
            </div>

            <!-- Loan tenure input -->
            <div>
                <label class="block text-gray-700 text-sm font-semibold">Loan tenure (months)</label>
                <input type="number" wire:model="loanTenure" placeholder="Loan tenure"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg bg-purple-50" min="1" />
            </div>

            <!-- Added interest display -->
            <div class="flex flex-col justify-end items-end">
                <label class="block text-gray-700 text-sm font-semibold">Added interest</label>
                <h2 class="text-xl font-semibold text-gray-800 mt-1">Rs: {{ number_format($addedInterest, 2) }}</h2>
            </div>

            <!-- Interest rate input -->
            <div>
                <label class="block text-gray-700 text-sm font-semibold">Interest rate (%)</label>
                <input type="number" wire:model="interestRate" placeholder="Interest rate"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-lg bg-purple-50" min="0"
                    step="any" />
            </div>

            <!-- Monthly amount display -->
            <div class="flex flex-col justify-end items-end">
                <label class="block text-gray-700 text-sm font-semibold">Monthly amount</label>
                <h2 class="text-xl font-semibold text-gray-800 mt-1">Rs: {{ number_format($monthlyAmount, 2) }}</h2>
            </div>
        </div>

        <!-- Calculate button -->
        <div class="flex justify-center">
            <button class="bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700" wire:click="calculate">
                Calculate
            </button>
        </div>
    </div>
</div>
