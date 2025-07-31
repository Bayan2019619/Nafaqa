@extends('layouts.app')

@section('content')
    <h1>Profile Role Details</h1>

    <p><strong>Name:</strong> {{ $profileRole->first_name }} {{ $profileRole->last_name }}</p>
    <p><strong>National No:</strong> {{ $profileRole->national_no }}</p>
    <p><strong>IBAN:</strong> {{ $profileRole->IBAN }}</p>
    <p><strong>Document:</strong> {{ $profileRole->document_type }} - {{ $profileRole->document_no }}</p>
    <p><strong>Date of Birth:</strong> {{ $profileRole->date_of_birth }}</p>
    <p><strong>Nationality:</strong> {{ $profileRole->nationality->name ?? '' }}</p>
    <p><strong>Status:</strong> {{ $profileRole->status ? 'Active' : 'Inactive' }}</p>

    <a href="{{ route('profile-roles.edit', $profileRole) }}">Edit</a>
    <a href="{{ route('profile-roles.index') }}">Back</a>
@endsection
