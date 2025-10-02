<x-app-layout>
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-semibold text-gray-800 mb-6 text-center">Add New Advertisement</h1>

        @if (session('success'))
            <div class="mb-4 text-green-500 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('advertisement.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-8 rounded-xl shadow-2xl border border-gray-200 space-y-6 max-w-4xl mx-auto">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-lg font-medium text-gray-700 mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required />
                @error('title')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="city" class="block text-lg font-medium text-gray-700 mb-2">City</label>
                <input type="text" id="city" name="city" value="{{ old('city') }}"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required />
                @error('city')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="country" class="block text-lg font-medium text-gray-700 mb-2">Country</label>
                <input type="text" id="country" name="country" value="{{ old('country') }}"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required />
                @error('country')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_rooms" class="block text-lg font-medium text-gray-700 mb-2">Number of Rooms</label>
                <input type="number" id="no_rooms" name="no_rooms" value="{{ old('no_rooms') }}"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
                @error('no_rooms')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="property_size" class="block text-lg font-medium text-gray-700 mb-2">Property Size (sqft or
                    m²)</label>
                <input type="number" id="property_size" name="property_size" value="{{ old('property_size') }}"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
                @error('property_size')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-lg font-medium text-gray-700 mb-2">Price</label>
                <input type="number" step="0.01" max='1000000000' id="price" name="price"
                    value="{{ old('price') }}"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
                @error('price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="property_type" class="block text-lg font-medium text-gray-700 mb-2">Property Type</label>
                <select id="property_type" name="property_type"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required>
                    <option value="" disabled {{ old('property_type') ? '' : 'selected' }}>Select Property Type
                    </option>
                    <option value="house" {{ old('property_type') == 'house' ? 'selected' : '' }}>House</option>
                    <option value="flat" {{ old('property_type') == 'flat' ? 'selected' : '' }}>Flat</option>
                    <option value="villa" {{ old('property_type') == 'villa' ? 'selected' : '' }}>Villa</option>
                </select>
                @error('property_type')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image_path" class="block text-lg font-medium text-gray-700 mb-2">Upload Image</label>
                <input type="file" id="image_path" name="image_path"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required />
                @error('image_path')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-gradient-to-r from-purple-500 to-purple-700 text-white px-8 py-3 rounded-full shadow-md hover:from-purple-600 hover:to-purple-800 transition ease-in-out duration-300">
                    Save Advertisement
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
