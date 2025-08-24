@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.users') }}" 
                   class="text-blue-600 hover:text-blue-700 dark:text-blue-400 font-medium">
                    ← Back to Users
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    User Details: {{ $user->name }}
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- User Information -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            User Information
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Name</label>
                                <p class="text-sm text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                                <p class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                            </div>
                            
                            @if($user->phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</label>
                                    <p class="text-sm text-gray-900 dark:text-gray-100">{{ $user->phone }}</p>
                                </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Role</label>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : '' }}
                                    {{ $user->role === 'landlord' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                    {{ $user->role === 'tenant' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                ">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Status</label>
                                @if($user->email_verified_at)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Verified
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Unverified
                                    </span>
                                @endif
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Joined</label>
                                <p class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $user->created_at->format('M d, Y \a\t g:i A') }}
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</label>
                                <p class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $user->updated_at->format('M d, Y \a\t g:i A') }}
                                </p>
                            </div>
                        </div>

                        <!-- Admin Actions -->
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-3">
                                Admin Actions
                            </h4>
                            
                            <div class="space-y-3">
                                <!-- Change Role -->
                                <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center space-x-2">
                                        <select name="role" class="text-sm border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
                                            <option value="tenant" {{ $user->role === 'tenant' ? 'selected' : '' }}>Tenant</option>
                                            <option value="landlord" {{ $user->role === 'landlord' ? 'selected' : '' }}>Landlord</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm font-medium transition-colors">
                                            Update Role
                                        </button>
                                    </div>
                                </form>
                                
                                <!-- Delete User -->
                                @if($user->id !== auth()->id())
                                    <form method="POST" 
                                          action="{{ route('admin.users.destroy', $user) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this user? This will also delete all their properties and cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors w-full">
                                            Delete User Account
                                        </button>
                                    </form>
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                                        You cannot delete your own account.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User's Properties -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            @if($user->role === 'landlord')
                                Properties ({{ $user->properties->count() }})
                            @else
                                User Activity
                            @endif
                        </h3>
                        
                        @if($user->role === 'landlord' && $user->properties->count() > 0)
                            <div class="space-y-4">
                                @foreach($user->properties as $property)
                                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $property->title }}
                                                </h4>
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                    {{ $property->location }}
                                                </p>
                                                <p class="text-sm text-gray-900 dark:text-gray-100 font-medium mt-1">
                                                    UGX {{ number_format($property->price) }}/month
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                                    Created: {{ $property->created_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                            
                                            <div class="flex flex-col items-end space-y-2">
                                                <!-- Status Badge -->
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    {{ $property->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                                    {{ $property->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                                                    {{ $property->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}
                                                ">
                                                    {{ ucfirst($property->status) }}
                                                </span>
                                                
                                                <!-- Actions -->
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.properties.show', $property) }}" 
                                                       class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm">
                                                        View
                                                    </a>
                                                    <a href="{{ route('properties.show', $property) }}" 
                                                       class="text-green-600 hover:text-green-700 dark:text-green-400 text-sm">
                                                        Public
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif($user->role === 'landlord')
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 11h10M7 15h10"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">
                                    This landlord hasn't created any properties yet.
                                </p>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ ucfirst($user->role) }} users don't create properties.
                                </p>
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">
                                    They browse and contact landlords about available properties.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
