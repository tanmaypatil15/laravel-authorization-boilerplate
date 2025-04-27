<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Change Password') }}
            </h2>
            <a href="{{ route('users.index') }}"
                class="px-6 py-2 rounded-sm bg-indigo-600 text-blue-100 hover:underline text-sm">Back</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-700 text-gray-200 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 text-gray-200">

                <form action="{{ route('users.update-password', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-4">
                        Account Name:<h2 for="user_name" class="block font-bold text-lg">{{ $user->name }}</h2>
                    </div>

                    <div class="mb-4">
                        <label for="current_password" class="block font-medium text-sm">Current Password</label>
                        <input type="password" name="current_password" id="current_password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block font-medium text-sm">Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm">
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block font-medium text-sm">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm">
                    </div>

                    <div>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Update Password
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
