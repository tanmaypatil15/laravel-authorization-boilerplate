<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Edit User') }}
            </h2>
            <a href="{{ route('users.index') }}"
                class="px-6 py-2 rounded-sm bg-indigo-600 text-blue-100 hover:underline text-sm">Back</a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-700 text-gray-200 shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 text-gray-200">
                {{-- Display Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="font-medium text-red-600">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Display Success Message --}}
                @if (session('status'))
                    <div class="mb-4">
                        <div class="font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                {{-- Edit User Form --}}
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div style="margin:0; passing:0;">
                        <label for="name" class="block font-medium text-sm">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                            required>
                    </div>

                    <div>
                        <label for="email" class="block font-medium text-sm">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                            required>
                    </div>

                    <div>
                        <label for="phone" class="block font-medium text-sm">Phone</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black focus:ring focus:ring-indigo-200 text-sm"
                            required>
                    </div>

                    <div class="mt-4">
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="is_active" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                {{ $user->is_active ? 'checked' : '' }}>
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
                                        {{ $user->roles->pluck('name')->contains($role->name) ? 'checked' : '' }}>
                                    <span class="text-sm capitalize pr-4">{{ $role->name }}</span>
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
</x-app-layout>



{{-- @extends('layouts.master') --}}


{{-- @section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Edit User
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </h2>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" value="{{ $user->name }}" name="name" class="form-control"
                        placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                        placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" name="password" class="form-control"
                        placeholder="Password">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    <input type="password" name="confirm-password" class="form-control"
                        placeholder="Confirm Password">
                </div>
            </div>
            {{-- <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Role:</strong>
                    <select class="form-control multiple" multiple name="roles[]">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

@endsection --}}
