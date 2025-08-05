<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            Manage Permissions for User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-8 px-4 max-w-6xl mx-auto">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-3 gap-6">
        @foreach ($groupedPermissions as $feature => $permissions)
            <div>
                <h3 class="font-semibold text-base mb-2 capitalize">{{ $feature }}</h3>
                <div class="space-y-2">
                    @foreach ($permissions as $permission)
                        <label class="flex items-center space-x-2 text-sm">
                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->name }}"
                                @checked($user->permissions->contains('name', $permission->name))
                                class="form-checkbox h-4 w-4 text-indigo-600"
                            >
                            <span>{{ Str::after($permission->name, $feature . '.') }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        <button
            type="submit"
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
        >
            Update Permissions
        </button>
    </div>
</form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</x-app-layout>