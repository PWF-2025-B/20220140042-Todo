<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Category Name')" />
                            <x-text-input 
                                id="title" 
                                name="title" 
                                type="text" 
                                type="text" 
                                class="block w-full mt-1" 
                                required 
                                autofocus 
                                autocomplete="name" 
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>

                            <x-link-button href="{{ route('category.index') }}">
                                {{ __('Cancel') }}
                            </x-link-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
