@extends('layouts.app')

@section('content')
    <h1>Create Profile Role</h1>

    <form action="{{ route('profile-roles.store') }}" method="POST">
        @csrf
        @include('profile_roles.form')
        <button type="submit">Save</button>
    </form>
@endsection
