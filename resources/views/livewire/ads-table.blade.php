<div>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Manage Advertisements</h1>
        <div class="bg-white rounded-lg shadow-lg overflow-x-auto max-h-screen overflow-y-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 text-left font-semibold">Advertisement Title</th>
                        <th class="py-3 px-4 text-left font-semibold">Location</th>
                        <th class="py-3 px-4 text-left font-semibold">Price Rs:</th>
                        <th class="py-3 px-4 text-left font-semibold">Valuation Status</th>
                        <th class="py-3 px-4 text-left font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ads as $ad)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 font-bold">{{ $ad->title }}</td>
                            <td class="py-3 px-4 font-bold">{{ $ad->city }}, {{ $ad->country }}</td>
                            <td class="py-3 px-4">{{ $ad->price }}</td>
                            <td class="py-3 px-4">
                                <span class="font-semibold text-green-600">
                                    {{-- Check if admin_id is null to determine valuation status --}}
                                    {{ $ad->admin_id ? 'Valuated' : 'Not Valuated' }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                @if (!$ad->admin_id)
                                    {{-- Show validate button only if admin_id is null --}}
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
                                        wire:click="validateAd({{ $ad->id }})">Validate</button>
                                @endif
                                <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 mt-2"
                                    wire:click="removeAd({{ $ad->id }})">Remove</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-3 px-4 text-center text-gray-500">No advertisements found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
