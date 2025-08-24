@extends('layouts.dashboard')

@section('content')
<!-- Properties Management Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Property Management</h1>
            <p class="text-gray-600">Review and manage all platform properties</p>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">Manage Properties</h2>
                        <p class="text-gray-600 dark:text-gray-400">Review and manage all property listings</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Total: {{ $properties->total() }} properties
                    </div>
                </div>

                <!-- Filters -->
                <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Status Filter -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Filter by Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white text-sm">
                                <option value="">All Status</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending Review</option>
                                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Search Properties</label>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Title, location, or landlord..."
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white text-sm"
                            >
                        </div>

                        <!-- Submit -->
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Filter
                            </button>
                        </div>
                    </form>

                    @if(request()->hasAny(['status', 'search']))
                        <div class="mt-3">
                            <a href="{{ route('admin.properties') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400">
                                Clear all filters
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Properties Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($properties as $property)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-600">
                            <!-- Property Image -->
                            <div class="relative h-48">
                                @if($property->image_path)
                                    <img src="{{ asset('storage/' . $property->image_path) }}" 
                                         alt="{{ $property->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $property->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $property->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $property->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                    ">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Property Details -->
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $property->title }}
                                </h3>
                                
                                <div class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $property->location }}
                                    </p>
                                    
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        UGX {{ number_format($property->price) }}/month
                                    </p>
                                    
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        by {{ $property->user->name }}
                                    </p>
                                    
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $property->created_at->format('M d, Y') }}
                                    </p>
                                    
                                    <div class="flex items-center space-x-4 text-xs">
                                        <span>{{ $property->bedrooms }} beds</span>
                                        <span>{{ $property->bathrooms }} baths</span>
                                        <span>{{ ucfirst($property->type) }}</span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="mt-4 flex flex-wrap gap-2">
                                    <!-- View Details -->
                                    <a href="{{ route('admin.properties.show', $property) }}" 
                                       class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md text-sm font-medium text-center transition-colors">
                                        View Details
                                    </a>
                                    
                                    <!-- Quick Status Actions -->
                                    @if($property->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.properties.update-status', $property) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" 
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                                Approve
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($property->status !== 'rejected')
                                        <form method="POST" action="{{ route('admin.properties.update-status', $property) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <!-- Delete Property -->
                                    <form method="POST" 
                                          action="{{ route('admin.properties.destroy', $property) }}" 
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this property? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                                </svg>
                                <p class="text-lg font-medium text-gray-500 dark:text-gray-400">No properties found</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500">Try adjusting your search or filters</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($properties->hasPages())
                    <div class="mt-8">
                        {{ $properties->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
