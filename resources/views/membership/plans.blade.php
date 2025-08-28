@extends('layouts.app')  {{-- or your layout file --}}

@section('content')
<div class="membership-container">
    <h1>Membership Plans</h1>
    <div class="plans">
        @foreach($plans as $plan)
        <div class="plan-card">
            <h2>{{ $plan->name }}</h2>
            <p>Price: ${{ $plan->price }}</p>
            <p>Duration: {{ $plan->duration }} days</p>
            <a href="{{ route('membership.subscribe', $plan->id) }}" class="btn">Get Membership</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
