@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="profile-container">
    <h1>Edit Profile</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- Profile Photo -->
        <label>Profile Photo:</label><br>
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 15px;">
            @if($user->photo && file_exists(public_path('storage/' . $user->photo)))
                <img src="{{ asset('storage/' . $user->photo) }}" width="100" height="100" alt="Profile Photo">
            @else
                <img src="{{ asset('images/default-profile.png') }}" width="100" height="100" alt="Default Photo">
            @endif
            <input type="file" name="photo">
        </div>

        <!-- Name -->
        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name', $user->name) }}"><br>

        <!-- Email -->
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email', $user->email) }}"><br>

        <!-- Birthdate -->
        <label>Birthdate:</label><br>
        <input type="date" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}"><br>

        <!-- NID -->
        <label>NID:</label><br>
        <input type="text" name="nid" value="{{ old('nid', $user->nid) }}"><br>

        <!-- Location -->
        <label>Location:</label><br>
        <input type="text" name="location" value="{{ old('location', $user->location) }}"><br>

        <button type="submit">Save Changes</button>
    </form>
</div>
@endsection
