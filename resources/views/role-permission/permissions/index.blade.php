<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Permissions') }}
            </h2>
            @can('create permission')
                <a href="{{ url('permissions/create') }}"
                    class="px-4 py-2 btn-sm rounded-sm bg-indigo-600 text-blue-100 hover:underline text-sm">Add
                    Permission</a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="bg-gray-700 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="text-gray-900">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-200">
                        <thead class="bg-gray-700 border-b uppercase text-xs text-gray-200">
                            <tr>
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $permission)
                                <tr>
                                    <td class="px-6 py-4">{{ $permission->id }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $permission->name }}</td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        @can('update permission')
                                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                                class="text-gray-200 bg-indigo-600 px-4 py-1">Edit</a>
                                        @endcan

                                        @can('delete permission')
                                            <form action="{{ route('permissions.destroy', $permission->id) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No permissions found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
