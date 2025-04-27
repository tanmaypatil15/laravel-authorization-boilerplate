<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Create Role') }}
            </h2>
            <a href="{{ route('roles.index') }}"
                class="px-6 py-2 rounded-sm bg-indigo-600 text-blue-100 hover:underline text-sm">Back</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="bg-gray-700 text-gray-200 shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-gray-200">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div style="margin:0; padding:0;">
                            <label for="role_name" class="block font-medium text-sm">Role Name</label>
                            <input type="text" name="role_name" id="role_name"
                                value="{{ old('role_name', $role->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                                required>
                        </div>

                        <div class="mt-4">
                            <label class="block font-medium text-sm mb-1">Permissions</label>
                            <div class="space-y-1">
                                @foreach ($permissions as $permission)
                                    <label class="inline-flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            {{ $role->permissions->pluck('name')->contains($permission->name) ? 'checked' : '' }}>
                                        <span class="text-sm capitalize pr-4">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
