<div>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Manage Users</h1>
        <div class="bg-white rounded-lg shadow-lg overflow-x-auto max-h-screen overflow-y-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 text-left font-semibold">Name</th>
                        <th class="py-3 px-4 text-left font-semibold">Email</th>
                        <th class="py-3 px-4 text-left font-semibold">User Type</th>
                        <th class="py-3 px-4 text-left font-semibold">Status</th>
                        <th class="py-3 px-4 text-left font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 font-bold">{{ $user->name }}</td>
                            <td class="py-3 px-4 font-bold">{{ $user->email }}</td>
                            <td class="py-3 px-4">{{ $user->user_type }}</td>
                            <td class="py-3 px-4">
                                <span
                                    class="status-badge {{ $user->status === 0 ? 'text-red-600' : 'text-green-600' }} font-semibold">
                                    {{ $user->status === 0 ? 'Blocked' : 'Active' }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                @if ($user->status === 0)
                                    <button
                                        class="block-btn bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700"
                                        wire:click="userAction({{ $user->id }})">Unblock</button>
                                @else
                                    <button
                                        class="block-btn bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                                        wire:click="userAction({{ $user->id }})">Block</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-3 px-4 text-center text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
