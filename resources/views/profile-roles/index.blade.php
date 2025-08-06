<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('profileRoles') }}
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
                        <th class="px-6 py-3">{{__('Creator')}}</th>
                        <th class="px-6 py-3">{{__('Status')}}</th>
                        <th class="px-6 py-3">{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($profileRoles as $profileRole)
                        @php
                            $statusEnum = $profileRole->status;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $profileRole->first_name}} {{ $profileRole->mid_name}} {{ $profileRole->last_name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $profileRole->creatorName}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-block w-3 h-3 rounded-full mr-2 bg-{{$statusEnum->realColor()}}-500"></span>
                                {{ __($statusEnum->label()) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="flex space-x-3 items-center">
@can('changeStatus', $profileRole)
    <a href="{{ route('profile-roles.show-review', ['profileRole' => $profileRole->id]) }}"
       title="{{ __('Review Profile') }}"
       class="text-gray-600 hover:text-blue-600 mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M5.121 17.804A9.964 9.964 0 0112 15c2.21 0 4.248.714 5.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    </a>
@endcan

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No profileRoles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $profileRoles->links() }}
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



