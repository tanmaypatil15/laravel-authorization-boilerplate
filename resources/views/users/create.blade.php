<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Create User') }}
            </h2>
            <a href="{{ route('users.index') }}"
                class="px-6 py-2 rounded-sm bg-indigo-600 text-blue-100 hover:underline text-sm">Back</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-700 text-gray-200 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 text-gray-200">
                <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div style="margin:0; passing:0;">
                        <label for="name" class="block font-medium text-sm">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                            required>
                    </div>

                    <div>
                        <label for="email" class="block font-medium text-sm">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                            required>
                    </div>

                    <div>
                        <label for="phone" class="block font-medium text-sm">Phone</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                            required>
                    </div>

                    <div>
                        <label for="password" class="block font-medium text-sm">Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                            required>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block font-medium text-sm">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="is_active" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                {{ isset($user) && $user->is_active ? 'checked' : '' }}>
                            <span class="text-sm capitalize pr-4">Is_Active</span>
                        </label>
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">Roles</label>
                        <div class="space-y-1">
                            @foreach ($roles as $role)
                                <label class="inline-flex items-center space-x-2">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        {{ isset($user) && $user->roles->contains($role->id) ? 'checked' : '' }}>
                                    <span class="text-sm capitalize pr-4">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Create User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
