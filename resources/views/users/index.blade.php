<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3">{{__('Name')}}</th>
                        <th class="px-6 py-3">{{__('Phone')}}</th>
                        <th class="px-6 py-3">{{__('Status')}}</th>
                        <th class="px-6 py-3">{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($users as $user)
                        @php
                            $statusEnum = $user->status;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-block w-3 h-3 rounded-full mr-2 bg-{{ $statusEnum->realColor() }}-500"></span>
                                {{ __($statusEnum->label()) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-3 items-center">
                                    <!-- View (Eye) -->
                                    <a href="{{ route('users.show', $user) }}" title="View" class="text-gray-600 hover:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    <!-- Edit (Pencil) -->
                                    <a href="{{ route('users.edit', $user) }}" title="Edit" class="text-gray-600 hover:text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4L16.5 3.5z" />
                                        </svg>
                                    </a>

                                    <!-- Toggle Status (Lock / Unlock) -->
                                    <form method="POST" action="{{ route('users.toggleStatus', $user) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="Toggle Status" class="text-gray-600 hover:text-gray-900">
                                            @if($user->status)
                                            <!-- Locked icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="5" y="11" width="14" height="10" rx="2" ry="2"/>
                                                <path d="M7 11V7a5 5 0 0110 0v4" />
                                            </svg>
                                            @else
                                            <!-- Unlocked icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="5" y="11" width="14" height="10" rx="2" ry="2"/>
                                                <path d="M7 11V7a5 5 0 0110 0v4" />
                                                <line x1="7" y1="15" x2="17" y2="15" />
                                            </svg>
                                            @endif
                                        </button>
                                    </form>

                                    <!-- Delete (Trash) -->
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete" class="text-red-600 hover:text-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7" />
                                                <path d="M10 11v6" />
                                                <path d="M14 11v6" />
                                                <path d="M5 7h14" />
                                                <path d="M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
