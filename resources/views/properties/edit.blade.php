<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('properties.update', $property) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Property Title *
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   value="{{ old('title', $property->title) }}"
                                   required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Description *
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      required
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $property->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Price and Rooms -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Monthly Rent (UGX) *
                                </label>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       min="0"
                                       step="1000"
                                       value="{{ old('price', $property->price) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('price') border-red-500 @enderror">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Number of Rooms *
                                </label>
                                <select name="rooms" 
                                        id="rooms"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('rooms') border-red-500 @enderror">
                                    <option value="">Select rooms</option>
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('rooms', $property->rooms) == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i == 1 ? 'Room' : 'Rooms' }}
                                        </option>
                                    @endfor
                                    <option value="10+" {{ old('rooms', $property->rooms) == '10+' ? 'selected' : '' }}>10+ Rooms</option>
                                </select>
                                @error('rooms')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Location *
                            </label>
                            <input type="text" 
                                   name="location" 
                                   id="location"
                                   value="{{ old('location', $property->location) }}"
                                   placeholder="e.g., Kampala, Nakawa, Banda"
                                   required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('location') border-red-500 @enderror">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Current Image -->
                        @if($property->image_path)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Current Image
                                </label>
                                <img src="{{ Storage::url($property->image_path) }}" 
                                     alt="{{ $property->title }}"
                                     class="w-32 h-32 object-cover rounded-lg">
                            </div>
                        @endif
                        
                        <!-- Image Upload -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $property->image_path ? 'Replace Image' : 'Property Image' }}
                            </label>
                            <input type="file" 
                                   name="image" 
                                   id="image"
                                   accept="image/jpeg,image/jpg,image/png"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('image') border-red-500 @enderror">
                            <p class="mt-1 text-sm text-gray-500">JPG, JPEG, or PNG. Max size: 2MB</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Status (only for admins or property owners) -->
                        @auth
                            @if(auth()->user()->isAdmin() || auth()->user()->id === $property->user_id)
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Status
                                    </label>
                                    <select name="status" 
                                            id="status"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 @enderror">
                                        <option value="pending" {{ old('status', $property->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        @if(auth()->user()->isAdmin())
                                            <option value="approved" {{ old('status', $property->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ old('status', $property->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        @endif
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                        @endauth
                        
                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6">
                            <a href="{{ route('properties.show', $property) }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Property
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
