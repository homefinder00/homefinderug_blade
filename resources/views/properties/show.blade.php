<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $property->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if($property->image_path)
                    <img src="{{ Storage::url($property->image_path) }}" 
                         alt="{{ $property->title }}"
                         class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500 text-xl">No Image Available</span>
                    </div>
                @endif
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Property Details -->
                        <div class="md:col-span-2">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                                {{ $property->title }}
                            </h1>
                            
                            <div class="flex items-center text-gray-600 dark:text-gray-400 mb-4">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $property->location }}
                            </div>
                            
                            <div class="flex items-center text-gray-600 dark:text-gray-400 mb-6">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                {{ $property->rooms }} {{ $property->rooms == 1 ? 'Room' : 'Rooms' }}
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">Description</h3>
                                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                    {{ $property->description }}
                                </p>
                            </div>
                            
                            <div class="mb-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">Property Status</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($property->status === 'approved') bg-green-100 text-green-800
                                    @elseif($property->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Price -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                    UGX {{ number_format($property->price) }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400">per month</p>
                            </div>
                            
                            <!-- Landlord Info -->
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">
                                    Landlord
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-2">
                                    {{ $property->user->name }}
                                </p>
                                @if($property->user->phone)
                                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                                        📞 {{ $property->user->phone }}
                                    </p>
                                @endif
                                
                                @if($property->user->phone)
                                    <a href="https://wa.me/{{ str_replace('+', '', $property->user->phone) }}?text=Hi, I'm interested in your property: {{ $property->title }}" 
                                       target="_blank"
                                       class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                        </svg>
                                        Contact via WhatsApp
                                    </a>
                                @endif
                            </div>
                            
                            <!-- Actions for Property Owner -->
                            @auth
                                @if(auth()->user()->id === $property->user_id)
                                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">
                                            Manage Property
                                        </h3>
                                        <div class="space-y-2">
                                            <a href="{{ route('properties.edit', $property) }}" 
                                               class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block text-center">
                                                Edit Property
                                            </a>
                                            <form action="{{ route('properties.destroy', $property) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this property?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Delete Property
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                    
                    <!-- Back Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
                        <a href="{{ route('properties.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            ← Back to Properties
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
