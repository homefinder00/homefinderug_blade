@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.properties') }}" 
                   class="text-blue-600 hover:text-blue-700 dark:text-blue-400 font-medium">
                    ← Back to Properties
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Property Details
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Property Image & Basic Info -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Property Image -->
                    <div class="relative h-96">
                        @if($property->image_path)
                            <img src="{{ asset('storage/' . $property->image_path) }}" 
                                 alt="{{ $property->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                {{ $property->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $property->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $property->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                            ">
                                {{ ucfirst($property->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Property Details -->
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            {{ $property->title }}
                        </h2>
                        
                        <!-- Key Details Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                    {{ $property->bedrooms }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Bedrooms</div>
                            </div>
                            
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                    {{ $property->bathrooms }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Bathrooms</div>
                            </div>
                            
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="text-xl font-bold text-green-600 dark:text-green-400">
                                    {{ ucfirst($property->type) }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Property Type</div>
                            </div>
                            
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="text-xl font-bold text-purple-600 dark:text-purple-400">
                                    UGX {{ number_format($property->price) }}
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Per Month</div>
                            </div>
                        </div>
                        
                        <!-- Location -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Location</h3>
                            <p class="text-gray-600 dark:text-gray-400 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $property->location }}
                            </p>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Description</h3>
                            <div class="text-gray-600 dark:text-gray-400 whitespace-pre-line">
                                {{ $property->description }}
                            </div>
                        </div>
                        
                        <!-- Timestamps -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500 dark:text-gray-400">
                                <div>
                                    <span class="font-medium">Created:</span> 
                                    {{ $property->created_at->format('M d, Y \a\t g:i A') }}
                                </div>
                                <div>
                                    <span class="font-medium">Updated:</span> 
                                    {{ $property->updated_at->format('M d, Y \a\t g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Landlord Info & Admin Actions -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Landlord Information -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Landlord Information
                        </h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Name</label>
                                <p class="text-sm text-gray-900 dark:text-gray-100">{{ $property->user->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                                <p class="text-sm text-gray-900 dark:text-gray-100">{{ $property->user->email }}</p>
                            </div>
                            
                            @if($property->user->phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</label>
                                    <p class="text-sm text-gray-900 dark:text-gray-100">{{ $property->user->phone }}</p>
                                </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Joined</label>
                                <p class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $property->user->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Total Properties</label>
                                <p class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $property->user->properties()->count() }} properties
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.users.show', $property->user) }}" 
                               class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors text-center block">
                                View Landlord Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin Actions -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Admin Actions
                        </h3>
                        
                        <!-- Status Management -->
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                                    Change Status
                                </label>
                                
                                <div class="grid grid-cols-1 gap-2">
                                    @if($property->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.properties.update-status', $property) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" 
                                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                                ✓ Approve Property
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($property->status !== 'pending')
                                        <form method="POST" action="{{ route('admin.properties.update-status', $property) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" 
                                                    class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                                ⏳ Mark as Pending
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($property->status !== 'rejected')
                                        <form method="POST" action="{{ route('admin.properties.update-status', $property) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" 
                                                    class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                                ✗ Reject Property
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Quick Links -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                                    Quick Actions
                                </label>
                                
                                <div class="space-y-2">
                                    <a href="{{ route('properties.show', $property) }}" 
                                       class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors text-center block">
                                        View Public Page
                                    </a>
                                    
                                    <form method="POST" 
                                          action="{{ route('admin.properties.destroy', $property) }}" 
                                          onsubmit="return confirm('Are you sure you want to permanently delete this property? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                            🗑️ Delete Property
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Stats -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Property Statistics
                        </h3>
                        
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Property ID:</span>
                                <span class="text-gray-900 dark:text-gray-100">#{{ $property->id }}</span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Status:</span>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $property->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                    {{ $property->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                                    {{ $property->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}
                                ">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Days Online:</span>
                                <span class="text-gray-900 dark:text-gray-100">
                                    {{ $property->created_at->diffInDays(now()) }} days
                                </span>
                            </div>
                            
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Last Updated:</span>
                                <span class="text-gray-900 dark:text-gray-100">
                                    {{ $property->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
