@extends('layouts.app')

@section('content')
    <h1>Edit Profile Role</h1>

    <form action="{{ route('profile-roles.update', $profileRole) }}" method="POST">
        @csrf @method('PUT')
        @include('profile_roles.form')
        <button type="submit">Update</button>
    </form>
@endsection
