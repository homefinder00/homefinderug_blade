<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Property Title *
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   value="{{ old('title') }}"
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
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
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
                                       value="{{ old('price') }}"
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
                                        <option value="{{ $i }}" {{ old('rooms') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i == 1 ? 'Room' : 'Rooms' }}
                                        </option>
                                    @endfor
                                    <option value="10+" {{ old('rooms') == '10+' ? 'selected' : '' }}>10+ Rooms</option>
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
                                   value="{{ old('location') }}"
                                   placeholder="e.g., Kampala, Nakawa, Banda"
                                   required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('location') border-red-500 @enderror">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Image Upload -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Property Image
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
                        
                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6">
                            <a href="{{ route('properties.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create Property
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Information Box -->
            <div class="mt-6 bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700 dark:text-blue-200">
                            <strong>Note:</strong> Your property will be submitted for admin approval. 
                            Once approved, it will be visible to tenants searching for properties.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
