<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Transactions') }}
        </h2>
    </x-slot>




    <!-- Cards Section -->
    <div class="container mx-auto mt-10">
        <!-- Table for Transactions with Scroll -->
        <div class="overflow-y-scroll max-h-screen">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Amount</th>
                        <th class="px-6 py-3 text-left">Type</th>
                        <th class="px-6 py-3 text-left">User ID</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-6 py-4 text-gray-800">{{ $transaction->title }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $transaction->type }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $transaction->user_id }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</x-app-layout>
