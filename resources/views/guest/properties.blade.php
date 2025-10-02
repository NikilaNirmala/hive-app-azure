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
                    <img class="size-10 rounded-full object-cover"
                        src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="User profile" />
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



<form method="GET" action="{{ route('properties.search') }}" class="flex justify-center w-full mt-5">
    <div
        class="max-w-5xl w-full h-25 bg-purple-300/60 rounded-xl shadow-lg flex items-center px-6 space-x-4 font-[Montserrat]">
        <!-- Search Input -->
        <input type="text" name="query" placeholder="Search..." value="{{ request()->get('query') }}"
            class="flex-grow h-12 bg-red-50 rounded-lg px-5 text-zinc-800 text-lg font-semibold outline-none" />

        <!-- Search Button -->
        <button type="submit"
            class="w-36 h-12 bg-purple-900 rounded-lg text-white text-lg font-semibold hover:bg-purple-800 transition">
            Search
        </button>
    </div>
</form>

<!-- Display Advertisement Listings -->
<div class="flex justify-center mt-6 mb-5">
    {{ $advertisements->links() }}
</div>

<div class="flex flex-wrap justify-center gap-10 mt-10 mb-30">
    @forelse($advertisements as $advertisement)
        <div class="bg-white rounded-xl shadow-[0_8px_12px_rgba(147,112,219,0.5)] overflow-hidden w-70">
            <img src="{{ asset('uploads/' . $advertisement->image_path) }}" alt="Property Image"
                class="w-full h-60 object-cover rounded-t-xl" />
            <div class="p-4">
                <div class="flex items-center text-purple-600 font-semibold mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="overflow-hidden text-ellipsis whitespace-nowrap">{{ $advertisement->city }},
                        {{ $advertisement->country }}</span>
                </div>
                <div class="flex justify-between text-gray-600 font-semibold text-sm mb-4">
                    <span>🏠 {{ $advertisement->no_rooms }} Rooms</span>
                    <span>📏 {{ $advertisement->property_size }} sq ft</span>
                </div>
                <div class="flex justify-between items-center">
                    @isset(Auth::user()->id)
                        <a href="{{ route('ad.show', $advertisement->id) }}">
                            <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                                Show More
                            </button>
                        </a>
                    @else
                        <a href="{{ route('register') }}">
                            <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                                Sign up
                            </button>
                        </a>
                    @endisset
                    <span
                        class="text-2xl font-bold text-gray-800">${{ number_format($advertisement->price / 1000000, 1) }}M</span>
                </div>
            </div>
        </div>
    @empty
        <p>No advertisements available.</p>
    @endforelse
</div>

<!-- Pagination Links -->
<div class="flex justify-center mt-6 mb-5">
    {{ $advertisements->links() }}
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
