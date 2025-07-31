@extends('layouts.app')

@section('content')
    <h1>Profile Roles</h1>
    <a href="{{ route('profile-roles.create') }}">Create New</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

<table class="table">
    <thead>
        <tr>
            <th>User Phone</th>
            <th>Full Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($profiles as $profile)
        <tr>
            <td>{{ $profile->user->phone ?? '-' }}</td>
            <td>{{ $profile->first_name }} {{ $profile->mid_name }} {{ $profile->last_name }}</td>
            <td>
                @if($profile->status)
                    <span class="text-success">✔</span>
                @else
                    <span class="text-danger">✖</span>
                @endif
            </td>
            <td>
                <a href="{{ route('profile-roles.show', $profile) }}">👁️</a>
                <a href="{{ route('profile-roles.edit', $profile) }}">✏️</a>
                <form method="POST" action="{{ route('profile-roles.toggle-status', $profile) }}" style="display:inline;">
                    @csrf @method('PATCH')
                    <button style="background:none;border:none;" title="Toggle Status">
                        🔒
                    </button>
                </form>
                <form method="POST" action="{{ route('profile-roles.destroy', $profile) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button style="background:none;border:none;" title="Delete">
                        🗑️
                    </button>
                </form>
                <a href="{{ route('profile-roles.logs', $profile) }}">📝</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

    {{ $roles->links() }}
@endsection
