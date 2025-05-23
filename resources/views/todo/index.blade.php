<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('todo.create') }}" />
                        </div>

                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400">
                                    {{ session('success') }}
                                </p>
                            @endif

                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400">
                                    {{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="hidden px-6 py-3 md:block">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($todos as $todo)
                                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <a href="{{ route('todo.edit', $todo) }}" class="hover:underline">
                                            {{ $todo->title }}
                                        </a>
                                    </td>

                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $todo->category ? $todo->category->title : 'No Category' }}
                                    </td>

                                    <td class="hidden px-6 py-4 md:block">
                                        @if ($todo->is_done)
                                            <span
                                                class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-200">
                                                Completed
                                            </span>
                                        @else
                                            <span
                                                class="text-blue-500 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200">
                                                Ongoing
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            @if ($todo->is_done == false)
                                                <form action="{{ route('todo.complete', $todo) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="px-4 text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-200">
                                                        Complete
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('todo.uncomplete', $todo) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="px-2 text-blue-500 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-200">
                                                        Uncomplete
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('todo.destroy', $todo) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-2 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-600 transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td colspan="4" class="px-6 py-4 font-medium text-center text-gray-900 dark:text-white">
                                        No todos found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($todoCompleted > 0)
                        <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                            <form action="{{ route('todo.deletecompleted') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button>
                                    Delete All Completed Tasks
                                </x-primary-button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>