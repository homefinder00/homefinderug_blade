@extends('layouts.dashboard')

@section('content')
<!-- Users Management Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
            <p class="text-gray-600">Manage platform users and their roles</p>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">Manage Users</h2>
                        <p class="text-gray-600 dark:text-gray-400">Monitor and manage all platform users</p>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Total: {{ $users->total() }} users
                    </div>
                </div>

                <!-- Filters -->
                <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Search Users</label>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Name, email, or phone..."
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white text-sm"
                            >
                        </div>

                        <!-- Role Filter -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Filter by Role</label>
                            <select name="role" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white text-sm">
                                <option value="">All Roles</option>
                                <option value="tenant" {{ request('role') === 'tenant' ? 'selected' : '' }}>Tenant</option>
                                <option value="landlord" {{ request('role') === 'landlord' ? 'selected' : '' }}>Landlord</option>
                                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label class="block text-sm font-medium mb-1">Filter by Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-white text-sm">
                                <option value="">All Status</option>
                                <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Unverified</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Filter
                            </button>
                        </div>
                    </form>

                    @if(request()->hasAny(['search', 'role', 'status']))
                        <div class="mt-3">
                            <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400">
                                Clear all filters
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Users Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    User Details
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Properties
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Joined
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $user->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $user->email }}
                                            </div>
                                            @if($user->phone)
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $user->phone }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : '' }}
                                            {{ $user->role === 'landlord' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                            {{ $user->role === 'tenant' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                        ">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        @if($user->role === 'landlord')
                                            <span class="font-medium">{{ $user->properties_count }}</span> properties
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->email_verified_at)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                Verified
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                Unverified
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <!-- View User -->
                                            <a href="{{ route('admin.users.show', $user) }}" 
                                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                View
                                            </a>

                                            <!-- Role Change Dropdown -->
                                            <div class="relative inline-block text-left">
                                                <button type="button" 
                                                        onclick="toggleDropdown('role-{{ $user->id }}')"
                                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Change Role
                                                </button>
                                                <div id="role-{{ $user->id }}" 
                                                     class="hidden absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5">
                                                    <div class="py-1">
                                                        @foreach(['tenant', 'landlord', 'admin'] as $role)
                                                            @if($role !== $user->role)
                                                                <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="inline">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="role" value="{{ $role }}">
                                                                    <button type="submit" 
                                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                                        {{ ucfirst($role) }}
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete User -->
                                            @if($user->id !== auth()->id())
                                                <form method="POST" 
                                                      action="{{ route('admin.users.destroy', $user) }}" 
                                                      class="inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this user? This will also delete all their properties.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                            </svg>
                                            <p class="text-lg font-medium">No users found</p>
                                            <p class="text-sm">Try adjusting your search or filters</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="mt-6">
                        {{ $users->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    const isHidden = dropdown.classList.contains('hidden');
    
    // Hide all dropdowns
    document.querySelectorAll('[id^="role-"]').forEach(el => {
        el.classList.add('hidden');
    });
    
    // Show the clicked dropdown if it was hidden
    if (isHidden) {
        dropdown.classList.remove('hidden');
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick*="toggleDropdown"]')) {
        document.querySelectorAll('[id^="role-"]').forEach(el => {
            el.classList.add('hidden');
        });
    }
});
</script>
@endsection
