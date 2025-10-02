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
<section class="flex flex-col lg:flex-row items-center justify-between px-8 py-16 bg-white font-[Montserrat]">
    <!-- Left Side Content -->
    <div class="lg:w-1/2 w-full mb-10 lg:mb-0">
        <h1 class="text-4xl md:text-6xl font-extrabold text-[#333333] mb-6">
            Find Comfort and Luxury
        </h1>
        <p class="text-lg md:text-xl text-[#2F2F2F] font-semibold mb-8 leading-relaxed">
            Explore our curated selection of exquisite properties<br class="hidden md:block" />
            meticulously tailored to your needs.
        </p>
        @isset(Auth::user()->id)
        @else
            <a href="{{ route('register') }}"
                class="inline-block bg-[#471E8A] text-white text-lg font-semibold px-6 py-3 rounded-md hover:bg-[#3a1771] transition">
                Sign up
            </a>
        @endisset
    </div>

    <!-- Right Side Image -->
    <div class="lg:w-1/2 w-full">
        <img src="{{ asset('images/mainImage.png') }}" alt="Property Image" class="w-full h-auto" />
    </div>
</section>
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
<section class="max-w-6xl mx-auto px-6 py-16 flex flex-col md:flex-row items-center md:items-start gap-10">
    <!-- Left Image -->
    <div class="md:w-1/2">
        <img src="{{ asset('images/housingimage.jpg') }}" alt="Luxury House"
            class="w-full rounded-xl object-cover shadow-lg" />
    </div>

    <!-- Right Content -->
    <div class="md:w-1/2 space-y-6 font-[Montserrat] ml-20">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight">
            Discover Where <br />
            Dreams Live
        </h2>

        <p class="text-gray-700 text-base md:text-lg max-w-lg">
            Whether it's a charming cottage or a lavish estate, our expert team
            supports you at every step, turning your dream property into reality
        </p>

        <div class="flex space-x-12 mt-6">
            <div class="text-center">
                <p class="text-3xl font-extrabold text-gray-600">8K+</p>
                <p class="text-gray-600 font-semibold">Houses Available</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-extrabold text-gray-600">6K+</p>
                <p class="text-gray-600 font-semibold">Houses Sold</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-extrabold text-gray-600">2K+</p>
                <p class="text-gray-600 font-semibold">Trusted Agents</p>
            </div>
        </div>
    </div>
</section>
<section class="max-w-6xl mx-auto px-4 py-12 text-left font-montserrat">
    <div class="max-w-xl mx-auto text-center">
        <h2 class="text-3xl text-[#333333] font-extrabold">Why Choose Us</h2>
        <p class="text-sm font-semibold mb-10 text-gray-700 mt-2 text-[15px]">
            Guiding You to the Perfect Property with Expertise, Trust, and <br />
            Personalized Care.
        </p>
    </div>

    <div class="flex flex-wrap justify-center gap-8">
        <!-- Card 1 -->
        <div class="bg-purple-200 rounded-lg p-10 w-60 flex flex-col items-start shadow-md h-60">
            <div class="bg-purple-50 p-3 rounded-md mb-4">
                <svg class="w-7 h-7 text-purple-900" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM12 11.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                </svg>
            </div>
            <h3 class="font-bold text-[16px] mb-2">Expert Guidance</h3>
            <p class="text-[13px] font-semibold text-gray-600 w-45">
                Let our hiveAgents simplify your property journey with trusted
                expertise.
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-purple-200 rounded-lg p-10 w-60 flex flex-col items-start shadow-md h-60">
            <div class="bg-purple-50 p-3 rounded-md mb-4">
                <svg class="w-7 h-7 text-purple-900" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <h3 class="font-bold text-[16px] mb-2">Personalized Service</h3>
            <p class="text-[13px] font-semibold text-gray-600 w-45">
                Our services are tailored to your unique needs, ensuring a
                hassle-free journey.
            </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-purple-200 rounded-lg p-10 w-60 flex flex-col items-start shadow-md h-60">
            <div class="bg-purple-50 p-3 rounded-md mb-4">
                <svg class="w-7 h-7 text-purple-900" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm6-6v-3a6 6 0 0 0-12 0v3H4v10h16V11h-2zm-8-3a4 4 0 0 1 8 0v3H10v-3z" />
                </svg>
            </div>
            <h3 class="font-bold text-[16px] mb-2">Unmatched Security</h3>
            <p class="text-[13px] font-semibold text-gray-600 w-45">
                Experience peace of mind with our steadfast commitment to unmatched
                security.
            </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-purple-200 rounded-lg p-10 w-60 flex flex-col items-start shadow-md h-60">
            <div class="bg-purple-50 p-3 rounded-md mb-4">
                <svg class="w-7 h-7 text-purple-900" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M16 13c1.1 0 2-.9 2-2s-.9-2-2-2h-2v-2H8v6h6zm-6-2v-4H6v10h2v-6zm10 4h-2v-6h-2v2h-2v-4h6c1.1 0 2 .9 2 2v4z" />
                </svg>
            </div>
            <h3 class="font-bold text-[16px] mb-2">Exceptional Support</h3>
            <p class="text-[13px] font-semibold text-gray-600 w-45">
                Delivering peace of mind through our attentive and responsive
                support.
            </p>
        </div>
    </div>
</section>
<!--popular residences-->
<div class="max-w-xl mx-auto text-center mt-6">
    <h2 class="text-3xl text-[#333333] font-extrabold">
        Our popular residences
    </h2>
</div>
<!--residence-->
<div class="flex flex-wrap justify-center gap-8 mt-10 mb-30">
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
                        <a href="">
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
                        class="text-2xl font-bold text-gray-800">${{ number_format($advertisement->price / 1000000, 2) }}M</span>
                </div>
            </div>
        </div>
    @empty
        <p>No advertisements available.</p>
    @endforelse
</div>
<!--comments-->
<div class="max-w-xl mx-auto text-center">
    <h2 class="text-3xl text-[#333333] font-extrabold">Our top comments</h2>
</div>
<div class="flex flex-wrap justify-center gap-12 mt-2 mb-20">
    @forelse($reviews as $review)
        <div class="bg-white rounded-lg shadow-lg p-4 mb-4">
            <h3 class="text-xl font-semibold text-gray-800">{{ $review->title }}</h3>
            <div class="flex items-center text-yellow-500 mb-2">
                @for ($i = 0; $i < $review->rating; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                        <path d="M10 15l-5.5 3 2-6.5-5-4.5 6.5-.5L10 1l2.5 5.5 6.5 .5-5 4.5 2 6.5L10 15z" />
                    </svg>
                @endfor
                @for ($i = $review->rating; $i < 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 20 20"
                        class="w-5 h-5">
                        <path d="M10 15l-5.5 3 2-6.5-5-4.5 6.5-.5L10 1l2.5 5.5 6.5 .5-5 4.5 2 6.5L10 15z" />
                    </svg>
                @endfor
            </div>
            <p class="text-gray-600">{{ $review->comment }}</p>
        </div>
    @empty
        <p>No reviews available.</p>
    @endforelse
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
