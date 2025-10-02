<div class="min-h-screen bg-gray-100">
    <!-- Dashboard Container -->
    <div class="container mx-auto p-8">

        <!-- Dashboard Header with Add Button -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">My Advertisements</h1>
            <a href="{{ route('member.add') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Add Advertisement
            </a>
        </div>

        <!-- Cards Section -->
        <div class="container mx-auto mt-10">
            <!-- Table for Advertisements -->
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Location</th>
                        <th class="px-6 py-3 text-left">Rooms</th>
                        <th class="px-6 py-3 text-left">Size (Sq ft)</th>
                        <th class="px-6 py-3 text-left">Price</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($advertisements as $advertisement)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-6 py-4 text-gray-800">{{ $advertisement->title }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $advertisement->city }},
                                {{ $advertisement->country }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $advertisement->no_rooms }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ number_format($advertisement->property_size) }} Sq ft
                            </td>
                            <td class="px-6 py-4 text-gray-800">Rs: {{ number_format($advertisement->price) }}</td>
                            <td class="px-6 py-4 flex space-x-2">
                                <!-- Update Button -->
                                <form method="GET" action="{{ route('advertisement.edit', $advertisement->id) }}">
                                    <button type="submit"
                                        class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                                        Update
                                    </button>
                                </form>

                                <!-- Delete Button -->
                                <button wire:click="deleteAdvertisement({{ $advertisement->id }})"
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
