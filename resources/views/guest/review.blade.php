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



<div class=" flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Add a Review</h2>

        <form action="{{ route('review.submit') }}" method="POST" class="space-y-4">
            @csrf
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
                <script>
                    // Redirect to the same page after 2 seconds
                    setTimeout(function() {
                        window.location.href = window.location.href;
                    }, 2000);
                </script>
            @endif
            <!-- Title -->
            <div class="form-group">
                <label for="title" class="text-sm text-gray-600">Review Title</label>
                <input type="text" id="title" name="title"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Enter review title" required>
            </div>

            <!-- Rating -->
            <div class="form-group">
                <label for="rating" class="text-sm text-gray-600">Rating</label>
                <select id="rating" name="rating"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                    required>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>

            <!-- Comment -->
            <div class="form-group">
                <label for="comment" class="text-sm text-gray-600">Your Comment</label>
                <textarea id="comment" name="comment"
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                    rows="5" placeholder="Write your review here..." required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit"
                    class="w-full py-3 bg-purple-600 text-white font-semibold rounded-md hover:bg-purple-700 transition">Submit
                    Review</button>
            </div>
        </form>
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
