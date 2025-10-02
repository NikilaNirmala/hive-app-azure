<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Spline+Sans:wght@300..700&display=swap"
        rel="stylesheet" />
</head>
<!--header-->
<header class="flex flex-row items-center ml-5 font-[Montserrat]">
    <nav class="flex items-center justify-between w-full px-6 py-4">
        <!-- Logo Section -->
        <div class="flex flex-col items-center justify-center space-x-3">
            <img class="h-[50px] pl-2" src="{{ asset('images/hive_logo.png') }}" alt="HiveEstate logo" />
            <h1 class="text-1xl font-bold text-[#333333]">HiveEstate</h1>
        </div>

        <!-- Navigation Links -->
        <ul class="flex space-x-6">
            <li>
                <a href="{{ route('home') }}" class="text-[#333333] hover:text-black font-medium">Home</a>
            </li>
            <li>
                <a href="{{ route('properties') }}" class="text-[#333333] hover:text-black font-medium">Property</a>
            </li>
            <li>
                <a href="{{ route('services') }}" class="text-[#333333] hover:text-black font-medium">Services</a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="text-[#333333] hover:text-black font-medium">About</a>
            </li>
            <li>
                <a href="{{ route('review') }}" class="text-[#333333] hover:text-black font-medium">Add review</a>
            </li>
        </ul>

        <!-- User Actions -->
        <div class="flex items-center space-x-4">
            @isset(Auth::user()->id)
                <a href="{{ route('dashboard') }}" class="flex items-center mr-10">
                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="User profile" />
                </a>


                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-[#4F1E8A] text-white px-4 py-2 rounded-md hover:bg-[#3a1771] transition">
                        Log out
                    </button>
                </form>
            @else
                <a href="{{ route('register') }}"
                    class="bg-[#4F1E8A] text-white px-4 py-2 rounded-md hover:bg-[#3a1771] transition">
                    Sign up
                </a>
            @endisset
        </div>
    </nav>
</header>
<div class="container mx-auto p-8 min-h-screen">
    <!-- Property Details Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden md:flex md:space-x-8 p-8">
        <!-- Image Section -->
        <div class="w-full md:w-1/2">
            <img src="{{ $advertisement->image_path }}" alt="Property Image"
                class="w-full h-96 object-cover rounded-xl shadow-lg" />
        </div>

        <!-- Property Info Section -->
        <div class="flex flex-col justify-between w-full md:w-1/2 space-y-6">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $advertisement->title }}</h1>
                <div class="flex items-center text-gray-600 mb-4 space-x-4">
                    <span class="text-lg">{{ $advertisement->city }}, {{ $advertisement->country }}</span>
                    <span
                        class="px-4 py-2 text-white bg-purple-600 rounded-full text-sm font-semibold">{{ $advertisement->property_type }}</span>
                </div>
                <p class="text-gray-700 text-lg leading-relaxed mb-6">{{ $advertisement->description }}</p>

                <div class="flex justify-between text-gray-600 font-semibold text-sm mb-8">
                    <span>🏠 {{ $advertisement->no_rooms }} Rooms</span>
                    <span>📏 {{ number_format($advertisement->property_size) }} sq ft</span>
                </div>

                <!-- Price and Buy Now Button -->
                <div class="flex justify-between items-center">
                    <span class="text-3xl font-bold text-gray-800">
                        ${{ number_format($advertisement->price / 1000000, 1) }}M
                    </span>
                    <!-- Buy Now Button -->
                    <a href="{{ route('purchase', $advertisement->id) }}">
                        <button
                            class="bg-purple-600 text-white px-8 py-4 rounded-xl hover:bg-purple-700 transition duration-300 transform hover:scale-105">
                            Buy Now
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
<footer class="bg-purple-200 p-6 font-[montserrat]">
    <div class="container mx-auto flex justify-center items-center">
        <div>
            <div class="flex items-center mb-2">
                <img src="{{ asset('images/hive_logo.png') }}" class="h-8 pr-5" alt="" />
                <h3 class="text-lg font-semibold text-gray-800">HiveEstate</h3>
            </div>
            <p class="text-gray-600 text-sm font-medium">
                Find your perfect place, <br />
                without leaving yours.
            </p>
        </div>
        <div class="flex space-x-12 ml-30">
            <div>
                <h4 class="text-md font-semibold text-gray-800 mb-2">About</h4>
                <ul class="text-gray-600 text-sm space-y-1 font-medium">
                    <li>Our Story</li>
                    <li>Careers</li>
                    <li>Resources</li>
                </ul>
            </div>
            <div>
                <h4 class="text-md font-semibold text-gray-800 mb-2">Support</h4>
                <ul class="text-gray-600 text-sm space-y-1 font-medium">
                    <li>Contact Us</li>
                    <li>Terms of Service</li>
                </ul>
            </div>
            <div>
                <h4 class="text-md font-semibold text-gray-800 mb-2">Our Social</h4>
                <ul class="text-gray-600 text-sm space-y-1 font-medium">
                    <li><span class="mr-2">📸</span> Instagram</li>
                    <li><span class="mr-2">👍</span> Facebook</li>
                    <li><span class="mr-2">🐦</span> Twitter</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
