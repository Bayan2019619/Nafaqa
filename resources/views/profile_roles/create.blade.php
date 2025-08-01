<x-app-layout>
    <x-slot name="header">
        <h2><strong>{{ __('Create') }} {{ __('Profile') }}</strong></h2>
    </x-slot>

    <form action="{{ route('profile-roles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('profile_roles.form')
    <button type="submit">Save</button>
</form>
</x-app-layout>
