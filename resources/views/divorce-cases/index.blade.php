<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('divorceCases') }}
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
                        <th class="px-6 py-3">{{__('creator')}}</th>
                        <th class="px-6 py-3">{{__('Status')}}</th>
                        <th class="px-6 py-3">{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($divorceCases as $divorceCase)
                        @php
                            $statusEnum = $divorceCase->status;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $divorceCase->firstName}} {{ $divorceCase->midName}} {{ $divorceCase->lastName}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $divorceCase->firstName }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-block w-3 h-3 rounded-full mr-2 bg-{{$statusEnum->realColor()}}-500"></span>
                                {{ __($statusEnum->label()) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="flex space-x-3 items-center">

@can('changeStatus', $divorceCase)
                                    <!-- Toggle Status (Lock / Unlock) -->
                                    <form method="POST" action="{{ route('divorce-cases.toggleStatus', $divorceCase) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="Toggle Status" class="text-gray-600 hover:text-gray-900">
                                            @if($statusEnum->label() == 'Active')
                                            <!-- Locked icon -->
                                       
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="5" y="11" width="14" height="10" rx="2" ry="2"/>
                                                <path d="M17 11V7a5 5 0 00-9.9-1" />
                                                <line x1="7" y1="15" x2="17" y2="15" />
                                            </svg>

                                            @endif
                                            @if($statusEnum->label() == 'Inactive')
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
@endcan
@can('update', $divorceCase)
                                    <div class="flex items-center">
                                    <div class="mr-2">
                                    <!-- Edit (Pencil) -->
                                    <a href="{{ route('divorce-cases.edit', $divorceCase) }}" title="Edit" class="text-gray-600 hover:text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9" />
                                            <path d="M16.5 3.5a2.121 2.121 0 113 3L7 19l-4 1 1-4L16.5 3.5z" />
                                        </svg>
                                    </a>
                                    </div>
                                    </div>
@endcan
@can('delete', $divorceCase)

                                    <!-- Delete (Trash) -->
                                    <form method="POST" action="{{ route('divorce-cases.destroy', $divorceCase) }}" class="delete-form">
    @csrf
    @method('DELETE')
    <button type="button" title="Delete" class="delete-btn text-red-600 hover:text-red-800">
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
@endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No divorceCases found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $divorceCases->links() }}
        </div>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لا يمكن التراجع عن هذا الإجراء!",
                icon: 'warning',
                iconColor: '#e07b7b',  // softer red for warning icon
                showCancelButton: true,
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء',
                confirmButtonColor: '#d9534f',  // bootstrap's danger red
                cancelButtonColor: '#6c757d',   // bootstrap's secondary gray
                reverseButtons: true, // مناسب للغات اليمين لليسار
                buttonsStyling: true,
                customClass: {
                    popup: 'font-sans text-base p-6',
                    title: 'text-lg font-semibold',
                    confirmButton: 'px-6 py-2 rounded-md shadow-md',
                    cancelButton: 'px-6 py-2 rounded-md shadow-md',
                    content: 'mt-4 text-sm text-gray-700',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>



