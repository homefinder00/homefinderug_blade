<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RentHub') }} - Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 fixed w-full top-0 z-50">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Left Side: Logo + App Name + Sidebar Toggle -->
                    <div class="flex items-center space-x-4">
                        <!-- Sidebar Toggle Button -->
                        <button 
                            onclick="toggleSidebar()" 
                            class="lg:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        
                        <!-- Logo + App Name -->
                        <div class="flex items-center space-x-3">
                            <x-application-logo class="h-8 w-auto" />
                            <h1 class="text-xl font-bold text-gray-900">RentHub</h1>
                        </div>
                    </div>

                    <!-- Right Side: Notifications + User Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button 
                                onclick="toggleNotifications()" 
                                class="p-2 rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 relative">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                <!-- Notification Badge -->
                                <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                            </button>
                            
                            <!-- Notifications Dropdown -->
                            <div id="notifications-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                        <div class="flex items-start space-x-3">
                                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-900">New property approval required</p>
                                                <p class="text-xs text-gray-500 mt-1">2 minutes ago</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                                        <div class="flex items-start space-x-3">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-900">User registered successfully</p>
                                                <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50">
                                        <div class="flex items-start space-x-3">
                                            <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-900">System maintenance scheduled</p>
                                                <p class="text-xs text-gray-500 mt-1">3 hours ago</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-200">
                                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700">View all notifications</a>
                                </div>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="relative">
                            <button 
                                onclick="toggleUserMenu()" 
                                class="flex items-center space-x-2 p-2 rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </span>
                                </div>
                                <span class="hidden md:block text-sm font-medium text-gray-900">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- User Dropdown -->
                            <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-200">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role) }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>Profile</span>
                                    </div>
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>Settings</span>
                                    </div>
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Logout</span>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Sidebar -->
            <aside id="sidebar" class="fixed left-0 top-0 w-64 h-full bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 pt-20">
                <div class="p-4">
                    <!-- Search -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="space-y-2">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v1H8V5z"></path>
                            </svg>
                            <span class="font-medium">Dashboard</span>
                        </a>

                        <!-- Properties -->
                        <a href="{{ route('properties.index') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('properties.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                            </svg>
                            <span class="font-medium">Properties</span>
                        </a>

                        @if(Auth::user()->isLandlord())
                            <!-- My Properties -->
                            <a href="{{ route('landlord.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('landlord.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                                <span class="font-medium">My Properties</span>
                            </a>
                        @endif

                        @if(Auth::user()->isAdmin())
                            <!-- Admin Panel Section -->
                            <div class="pt-4">
                                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin Panel</h3>
                                <div class="mt-2 space-y-2">
                                    <!-- Admin Dashboard -->
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-purple-50 text-purple-700 border-r-2 border-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <span class="font-medium">Admin Dashboard</span>
                                    </a>

                                    <!-- Manage Users -->
                                    <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.users*') ? 'bg-purple-50 text-purple-700 border-r-2 border-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                        <span class="font-medium">Manage Users</span>
                                    </a>

                                    <!-- Manage Properties -->
                                    <a href="{{ route('admin.properties') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('admin.properties*') ? 'bg-purple-50 text-purple-700 border-r-2 border-purple-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                                        </svg>
                                        <span class="font-medium">Manage Properties</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Other Links -->
                        <div class="pt-4">
                            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Other</h3>
                            <div class="mt-2 space-y-2">
                                <!-- Profile -->
                                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-3 py-2 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="font-medium">Profile</span>
                                </a>

                                <!-- Settings -->
                                <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-medium">Settings</span>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </aside>

            <!-- Sidebar Overlay for Mobile -->
            <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden" onclick="toggleSidebar()"></div>

            <!-- Main Content -->
            <main class="lg:ml-64 pt-20">
                <div class="p-6">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- JavaScript for Interactivity -->
        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }

            function toggleNotifications() {
                const dropdown = document.getElementById('notifications-dropdown');
                const userDropdown = document.getElementById('user-dropdown');
                
                // Close user dropdown if open
                userDropdown.classList.add('hidden');
                
                dropdown.classList.toggle('hidden');
            }

            function toggleUserMenu() {
                const dropdown = document.getElementById('user-dropdown');
                const notificationsDropdown = document.getElementById('notifications-dropdown');
                
                // Close notifications dropdown if open
                notificationsDropdown.classList.add('hidden');
                
                dropdown.classList.toggle('hidden');
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                const userDropdown = document.getElementById('user-dropdown');
                const notificationsDropdown = document.getElementById('notifications-dropdown');
                const userButton = event.target.closest('[onclick="toggleUserMenu()"]');
                const notificationButton = event.target.closest('[onclick="toggleNotifications()"]');
                
                if (!userButton && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
                
                if (!notificationButton && !notificationsDropdown.contains(event.target)) {
                    notificationsDropdown.classList.add('hidden');
                }
            });

            // Auto-close mobile sidebar when window is resized to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebar-overlay');
                    
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            });
        </script>
    </body>
</html>
