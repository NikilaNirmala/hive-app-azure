<div>
    <div class="overflow-x-auto max-h-96 overflow-y-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg w-full">
            <!-- Table Header -->
            <thead class="bg-purple-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Title</th>
                    <th class="py-3 px-6 text-left">Contact Email</th>
                    <th class="py-3 px-6 text-left">Message</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through requests -->
                @forelse ($requests as $request)
                    <tr class="hover:bg-gray-100 border-b border-gray-200">
                        <td class="py-4 px-6">{{ $request->title }}</td>
                        <td class="py-4 px-6"><a
                                href="mailto:{{ $request->contact_email }}">{{ $request->contact_email }}</a></td>
                        <td class="py-4 px-6">{{ $request->message }}</td>
                        <td class="py-4 px-6 text-center">
                            <!-- Accept Button -->
                            {{-- <button
                                class="bg-purple-600 py-2 px-4 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                Accept
                            </button> --}}
                            <!-- Delete Button -->
                            <button
                                class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2"
                                wire:click="deleteRequest({{ $request->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <!-- If no requests are found -->
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                            No requests available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
