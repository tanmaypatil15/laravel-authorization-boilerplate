<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('users.create') }}"
                class="px-4 py-2 btn-sm rounded-sm bg-indigo-600 text-blue-100 hover:underline text-sm">Create User</a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-700 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="text-gray-900">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-200">
                        <thead class="bg-gray-700 border-b uppercase text-xs text-gray-200">
                            <tr>
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Phone</th>
                                <th class="px-6 py-3">Roles</th>
                                <th class="px-6 py-3">Is_Active</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->phone }}</td>
                                    <td class="px-6 py-4">
                                        @foreach ($user->getRoleNames() as $role)
                                            <span
                                                class="inline-block bg-gray-200 text-gray-800 text-xs px-4 py-1 capitalize font-bold rounded-full mr-1">
                                                {{ $role ?? 'N/A' }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">{{ $user->is_active ? 'Yes' : 'No' }}</td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('users.change-password', $user->id) }}"
                                            class="text-gray-200 bg-indigo-600 px-4 py-1">Change Password</a>
                                        {{-- <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:underline">View</a> --}}
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-gray-200 bg-indigo-600 px-4 py-1">Edit</a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        No users found.
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
