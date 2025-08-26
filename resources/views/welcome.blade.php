<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="HomeFinder Uganda - Find your perfect rental property in Uganda. Connect with trusted landlords and discover quality homes across Kampala, Entebbe, and beyond.">
        <meta name="keywords" content="Uganda rentals, property finder, homes for rent, apartments Uganda, houses for rent Kampala">
        <title>{{ config('app.name', 'HomeFinder') }} - Find Your Perfect Home in Uganda</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            .hero-gradient {
                background: 
                    linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(4, 1, 34, 0.8) 100%),
                    url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?ixlib=rb-4.0.3&auto=format&fit=crop&w=1996&q=80') center/cover;
                background-attachment: fixed;
            }
            .property-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .property-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            
            /* Mobile optimization for background image */
            @media (max-width: 768px) {
                .hero-gradient {
                    background-attachment: scroll;
                }
            }
        </style>
    </head>
    <body class="bg-gray-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <x-application-logo class="h-10 w-auto" />
                        <span class="ml-2 text-xl font-bold text-gray-900">HomeFinder Uganda</span>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#properties" class="text-gray-600 font-bold hover:text-gray-900 transition-colors" style="font-weight: 600;">Properties</a>
                        <a href="#features" class="text-gray-600  font-bold hover:text-gray-900 transition-colors" style="font-weight: 600;">Why Us</a>
                        <a href="#contact" class="text-gray-600 font-bold hover:text-gray-900 transition-colors" style="font-weight: 600;">Contact</a>
                    </div>
                    
                    <!-- Auth Links -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="text-gray-600 hover:text-gray-900 transition-colors">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-gradient pt-16 pb-20 relative overflow-hidden min-h-screen flex items-center">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            
            <!-- Floating Elements -->
            <div class="absolute top-20 left-10 animate-float">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full"></div>
            </div>
            <div class="absolute top-40 right-20 animate-float" style="animation-delay: -2s;">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full"></div>
            </div>
            <div class="absolute bottom-20 left-1/4 animate-float" style="animation-delay: -4s;">
                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full"></div>
            </div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                        Find Your Perfect Home
                        </span>
                        in Uganda
                    </h1>
                    <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                        Discover thousands of rental properties across Uganda. From apartments in Kampala to houses in Entebbe, find your next home with ease.
                    </p>
                    
                    <!-- Search Bar -->
                    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-2">
                        <form action="{{ route('properties.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                            <div class="flex-1">
                                <input type="text" 
                                       name="search" 
                                       placeholder="Search by location, property type..."
                                       class="w-full px-4 py-3 border-0 focus:ring-0 focus:outline-none text-gray-900 rounded-md">
                            </div>
                            <div class="flex flex-col md:flex-row gap-2">
                                <select name="type" class="px-4 py-3 border-0 focus:ring-0 focus:outline-none text-gray-900 rounded-md bg-gray-50">
                                    <option value="">All Types</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="house">House</option>
                                    <option value="studio">Studio</option>
                                    <option value="villa">Villa</option>
                                </select>
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-md font-medium transition-colors whitespace-nowrap">
                                    Search Properties
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 max-w-3xl mx-auto">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-2">{{ App\Models\Property::approved()->count() }}+</div>
                            <div class="text-gray-200">Active Properties</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-2">{{ App\Models\User::where('role', 'landlord')->count() }}+</div>
                            <div class="text-gray-200">Verified Landlords</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white mb-2">{{ App\Models\User::where('role', 'tenant')->count() }}+</div>
                            <div class="text-gray-200">Happy Tenants</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Why Choose HomeFinder?
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        We make finding and listing rental properties simple, secure, and efficient.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="text-center p-8 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Smart Search</h3>
                        <p class="text-gray-600">Find properties by location, price range, number of rooms, and more with our advanced filtering system.</p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="text-center p-8 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Verified Listings</h3>
                        <p class="text-gray-600">All properties are verified by our admin team to ensure quality and authenticity for your peace of mind.</p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="text-center p-8 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Direct Contact</h3>
                        <p class="text-gray-600">Connect directly with landlords via WhatsApp for quick responses and seamless communication.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Properties Section -->
        <section id="properties" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Featured Properties
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Discover some of our most popular rental properties across Uganda.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse(App\Models\Property::approved()->with('user')->latest()->limit(6)->get() as $property)
                        <div class="property-card bg-white rounded-lg shadow-md overflow-hidden">
                            <!-- Property Image -->
                            <div class="relative h-48 bg-gray-200">
                                @if($property->image_path)
                                    <img src="{{ asset('storage/' . $property->image_path) }}" 
                                         alt="{{ $property->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Price Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        UGX {{ number_format($property->price) }}/month
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Property Details -->
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $property->title }}</h3>
                                <p class="text-gray-600 flex items-center mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $property->location }}
                                </p>
                                
                                <!-- Property Features -->
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span>{{ $property->bedrooms }} beds</span>
                                    <span>{{ $property->bathrooms }} baths</span>
                                    <span>{{ ucfirst($property->type) }}</span>
                                </div>
                                
                                <!-- Action Button -->
                                <a href="{{ route('properties.show', $property) }}" 
                                   class="w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg font-medium transition-colors block">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Properties Yet</h3>
                            <p class="text-gray-600 mb-4">Be the first landlord to list your property!</p>
                            <a href="{{ route('register') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                Get Started
                            </a>
                        </div>
                    @endforelse
                </div>
                
                @if(App\Models\Property::approved()->count() > 6)
                    <div class="text-center mt-12">
                        <a href="{{ route('properties.index') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                            View All Properties
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-blue-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Ready to Find Your Next Home?
                </h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Join thousands of Ugandans who have found their perfect rental properties through HomeFinder.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('properties.index') }}" 
                       class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-medium transition-colors">
                        Browse Properties
                    </a>
                    <a href="{{ route('register') }}" 
                       class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        List Your Property
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="contact" class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <x-application-logo class="h-8 w-auto" />
                            <span class="ml-2 text-xl font-bold">HomeFinder</span>
                        </div>
                        <p class="text-gray-400 mb-4">
                            Uganda's premier rental property platform. Connecting landlords and tenants across the country with verified, quality properties.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <span class="sr-only">Facebook</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <span class="sr-only">Twitter</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-white transition-colors">Browse Properties</a></li>
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Register</a></li>
                        </ul>
                    </div>
                    
                    <!-- Contact -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact</h3>
                        <ul class="space-y-2">
                            <li class="text-gray-400">Kampala, Uganda</li>
                            <li class="text-gray-400">+256 123 456 789</li>
                            <li class="text-gray-400">hello@homefinder.ug</li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                    <p class="text-gray-400">
                        © {{ date('Y') }} HomeFinder Uganda. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Smooth Scrolling Script -->
        <script>
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
    </body>
</html>

