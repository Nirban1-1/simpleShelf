
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<div class="profile-container">
    <h1>My Profile</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Birthdate:</strong> {{ $user->birthdate ?? 'N/A' }}</p>
    <p><strong>NID:</strong> {{ $user->nid ?? 'N/A' }}</p>
    <p><strong>Location:</strong> {{ $user->location ?? 'N/A' }}</p>

    @if($user->photo)
        <p><strong>Photo:</strong></p>
        <img src="{{ asset('storage/' . $user->photo) }}" width="150">
    @endif

    <br><br>
    <a href="{{ route('profile.edit') }}">Edit Profile</a>
</div>
@endsection
