<x-app-layout>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Edit Advertisement</h1>

        @if (session('success'))
            <div class="mb-4 text-green-500 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('advertisement.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-8 rounded-xl shadow-2xl border border-gray-200 space-y-6 max-w-4xl mx-auto">
            @csrf
            @method('PUT') <!-- Ensures the form uses the PUT method -->

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-lg font-medium text-gray-700 mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $advertisement->title) }}"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required />
                @error('title')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-lg font-medium text-gray-700 mb-2">Price</label>
                <input type="number" id="price" name="price" value="{{ old('price', $advertisement->price) }}"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required />
                @error('price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image_path" class="block text-lg font-medium text-gray-700 mb-2">Upload New Image
                    (Optional)</label>
                <input type="file" id="image_path" name="image_path"
                    class="w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <p class="text-gray-500 text-sm mt-2">Current image:
                    <img src="{{ asset('uploads/' . $advertisement->image_path) }}" alt="Current Image"
                        class="w-20 h-20 object-cover rounded-md mt-2">
                </p>
                @error('image_path')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-gradient-to-r from-purple-500 to-purple-700 text-white px-8 py-3 rounded-full shadow-md hover:from-purple-600 hover:to-purple-800 transition ease-in-out duration-300">
                    Update Advertisement
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
