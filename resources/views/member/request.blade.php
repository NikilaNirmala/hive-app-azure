<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Send Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-2xl p-8">
                <form method="POST" action="{{ route('request.store') }}">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-lg font-semibold text-gray-700 mb-2">Title</label>
                        <input type="text" id="title" name="title"
                            class="w-full px-6 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required />
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <label for="message" class="block text-lg font-semibold text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message"
                            class="w-full px-6 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required></textarea>
                    </div>

                    <!-- Contact Email -->
                    <div class="mb-6">
                        <label for="contact_email" class="block text-lg font-semibold text-gray-700 mb-2">Contact
                            Email</label>
                        <input type="email" id="contact_email" name="contact_email"
                            class="w-full px-6 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value='{{ $user_email }}' required />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-purple-600 text-white px-8 py-3 rounded-full shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 transition ease-in-out duration-300">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
