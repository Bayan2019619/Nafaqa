<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold leading-tight">
            {{__('Manage Permissions for User')}} : {{ $user->name }}
        </h2>

        <div class="flex space-x-4">
                <button
                    type="submit"
                    form="permissions-form"
                    type="submit"
                     class="
              w-48
              px-2 py-2
              bg-blue-100
              text-blue-700
              font-semibold
              rounded-md
              hover:bg-blue-200
              focus:outline-none
              focus:ring-2
              focus:ring-blue-300
              focus:ring-offset-2
              transition
              duration-150
              ease-in-out
            "
                >
                    {{__('Update')}} {{__('Permissions')}} 
                </button>

                 &nbsp;&nbsp;&nbsp;
        <a href="{{ url()->previous() }}"
            class="
              w-48
              px-2 py-2
              bg-gray-200
              text-gray-700
              font-semibold
              rounded-md
              hover:bg-gray-200
              focus:outline-none
              focus:ring-2
              focus:ring-gray-300
              focus:ring-offset-2
              transition
              duration-150
              ease-in-out
              text-center
              inline-block
            "
        >
            {{ __('Back') }}
        </a>
            </div>
            </div>

    </x-slot>

    <div class="py-8 px-4 max-w-6xl mx-auto">
        <form method="POST" action="{{ route('users.update', $user->id) }}" id="permissions-form">
            @csrf
            @method('PUT')

               
            <!-- Flex container: 3 per row -->
            <div class="flex flex-wrap items-start gap-4">

                @foreach ($groupedPermissions as $feature => $permissions)
                    <div
                        x-data="{ isOpen: false }"
                        class="flex flex-col border rounded-lg shadow-sm w-1/4 px-2 mb-4"
                    >
                        <!-- Header -->
                        <button
                            type="button"
                            class="flex justify-between items-center px-4 py-2 bg-gray-100  rounded-t-lg"
                            @click="isOpen = !isOpen"
                        >
                            <span class="font-semibold">{{ __($feature)}}</span>
                            <svg :class="{ 'rotate-180': isOpen }" class="h-5 w-5 transition-transform duration-200"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Permissions -->
                        <div x-show="isOpen" x-collapse class="p-4 space-y-3">
                       @foreach ($permissions as $permission)
    <label class="flex items-center space-x-4 text-sm hover:bg-gray-50 px-2 py-1 rounded">
        <input
            type="checkbox"
            name="permissions[]"
            value="{{ $permission->name }}"
            @checked($user->permissions->contains('name', $permission->name))
            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
        >
        @php
        $permission = Str::after($permission->name, $feature . '.');
        @endphp
        <span>&nbsp;&nbsp;{{ __($permission) }}&nbsp;&nbsp;</span>
    </label>
@endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>
