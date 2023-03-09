<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Name : {{ Auth::user()->user_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex justify-between h-16">
                                <div class="flex">

                                    <!-- Navigation Links -->
                                    <div class="hidden text-sm space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                            {{ __('Users') }}
                                        </x-nav-link>

                                    </div>

                                </div>

                                <!-- Settings Dropdown -->
                                <div class="hidden sm:flex sm:items-center sm:ml-6">
                                    @role('Super Admin')
                                        <a href="{{ route('register') }}"
                                            class="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Add User
                                        </a>
                                    @endrole
                                </div>

                                <!-- Hamburger -->
                                <div class="-mr-2 flex items-center sm:hidden">
                                    <button @click="open = ! open"
                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h16M4 18h16" />
                                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <br>
                        @can('can-view-users')
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-md text-black uppercase dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Sr
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Phone Number
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $jey => $user)
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4">
                                                {{ $loop->index + 1 }}
                                            </th>
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $user->user_name }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $user->phone_number }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Admin'))
                                                    @if ($user->id != auth()->id())
                                                        <a href="{{ route('users.impersonate', $user->id) }}"
                                                            class="btn btn-warning btn-sm">Impersonate</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endcan
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@section('scripts')
@endsection
