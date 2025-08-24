<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Properties') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('properties.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                            <input type="text" 
                                   name="location" 
                                   id="location"
                                   value="{{ request('location') }}"
                                   placeholder="Enter location"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label for="min_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Min Price (UGX)</label>
                            <input type="number" 
                                   name="min_price" 
                                   id="min_price"
                                   value="{{ request('min_price') }}"
                                   placeholder="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label for="max_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Max Price (UGX)</label>
                            <input type="number" 
                                   name="max_price" 
                                   id="max_price"
                                   value="{{ request('max_price') }}"
                                   placeholder="1000000"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div>
                            <label for="rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rooms</label>
                            <select name="rooms" 
                                    id="rooms"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Any</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ request('rooms') == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? 'Room' : 'Rooms' }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        
                        <div class="md:col-span-4 flex justify-end space-x-2">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search
                            </button>
                            <a href="{{ route('properties.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Clear
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Properties Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($properties as $property)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        @if($property->image_path)
                            <img src="{{ Storage::url($property->image_path) }}" 
                                 alt="{{ $property->title }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                {{ $property->title }}
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-400 mb-2">
                                📍 {{ $property->location }}
                            </p>
                            
                            <p class="text-gray-600 dark:text-gray-400 mb-2">
                                🏠 {{ $property->rooms }} {{ $property->rooms == 1 ? 'Room' : 'Rooms' }}
                            </p>
                            
                            <p class="text-2xl font-bold text-green-600 mb-4">
                                UGX {{ number_format($property->price) }}
                            </p>
                            
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                {{ Str::limit($property->description, 100) }}
                            </p>
                            
                            <div class="flex justify-between items-center">
                                <a href="{{ route('properties.show', $property) }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    View Details
                                </a>
                                
                                <span class="text-sm text-gray-500">
                                    By {{ $property->user->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-3 text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400 text-lg">No properties found.</p>
                        @auth
                            @if(auth()->user()->isLandlord())
                                <a href="{{ route('properties.create') }}" 
                                   class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Create First Property
                                </a>
                            @endif
                        @endauth
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $properties->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
