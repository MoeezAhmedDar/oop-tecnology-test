<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="w-full max-w-lg" method="POST" action="{{ route('store.permissions') }}">
                        @csrf
                        <div class="w-full mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2"
                                for="grid-state">
                                Roles
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-state" name="role">
                                    <option>Select</option>
                                    @foreach ($roles as $role)
                                        <option value={{ $role->id }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-md mt-3 font-bold mb-2"
                                for="grid-state">
                                Permissions
                            </label>
                            <div class="relative">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-12">
                                        <div class="form-check checkbox">
                                            <input class="form-check-input" type="checkbox" name="permission[]"
                                                id="{{ $permission->id }}" value="{{ $permission->id }}">
                                            <label class="form-check-label"
                                                for="{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <input
                            class="ml-4 mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
