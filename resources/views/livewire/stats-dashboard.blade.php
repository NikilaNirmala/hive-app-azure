<div class="container mx-auto p-4">
    <!-- Grid with 2 rows -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
        <!-- Members Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-700">Members</h2>
            <p wire:poll.2s="updateCounts" id="members-count" class="text-4xl font-extrabold text-blue-600 mt-4">
                {{ $membersCount }}</p>
        </div>

        <!-- Agents Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-700">Agents</h2>
            <p wire:poll.2s="updateCounts" id="agents-count" class="text-4xl font-extrabold text-green-600 mt-4">
                {{ $agentsCount }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mt-8">
        <!-- Admins Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-700">Admins</h2>
            <p wire:poll.2s="updateCounts" id="admins-count" class="text-4xl font-extrabold text-purple-600 mt-4">
                {{ $adminsCount }}</p>
        </div>

        <!-- Advertisements Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 text-center border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-700">Advertisements</h2>
            <p wire:poll.2s="updateCounts" id="ads-count" class="text-4xl font-extrabold text-orange-600 mt-4">
                {{ $adsCount }}</p>
        </div>
    </div>
</div>
