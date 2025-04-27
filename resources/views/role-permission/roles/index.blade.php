<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Roles') }}
            </h2>
            @can('create role')
                <a href="{{ url('roles/create') }}"
                    class="px-4 py-2 btn-sm rounded-sm bg-indigo-600 text-blue-100 hover:underline text-sm">Add Role</a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-700 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="text-gray-900">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-200">
                        <thead class="bg-gray-700 border-b uppercase text-xs text-gray-200">
                            <tr>
                                <th class="w-24 px-6 py-3">#</th>
                                <th class="w-32 px-6 py-3">Name</th>
                                <th class="w-96 px-6 py-3">Permissions</th>
                                <th class="w-40 px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td class="px-6 py-4">{{ $role->id }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $role->name }}</td>
                                    <td class="px-6 py-4">
                                        @foreach ($role->permissions as $permission)
                                            <span
                                                class="inline-block bg-gray-100 text-gray-800 capitalize px-2 py-1 rounded-full text-xs font-bold mr-2 mb-2">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        @can('update role')
                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                class="text-gray-200 bg-indigo-600 px-4 py-1">Edit</a>
                                        @endcan

                                        @can('delete role')
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                class="inline">
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
                                        No roles found.
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
