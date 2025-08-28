@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">

    {{-- Membership Section --}}
    @if(!$hasMembership)
    <div class="membership-header text-center mb-5">
        <h4 class="membership-title">Get a Membership</h4>
        <p class="membership-subtitle">Choose a plan that fits your reading needs</p>
    </div>

    <div class="membership-container">
        @foreach($plans as $plan)
        <div class="plan-card shadow-sm text-center {{ strtolower($plan->name) }}">
            <h4 class="plan-name">{{ ucfirst($plan->name) }} Plan</h4>
            <div class="underline"></div>
            <p class="plan-description">{{ $plan->description }}</p>
            <p class="plan-price"><strong>${{ $plan->price }}</strong></p>
            <p class="plan-duration">Duration: {{ $plan->duration }} days</p>
            <form action="{{ route('membership.subscribe', $plan->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-block mt-3">Get Membership</button>
            </form>
        </div>
        @endforeach
    </div>
    @else
{{-- Issued Books Section --}}
<h3 class="section-title text-center mb-4">Your Issued Books</h3>

@if($issuedBooks->isEmpty())
    <p class="text-center text-muted">You have not issued any books yet.</p>
@else
    <div class="issued-books-container">
    @foreach($issuedBooks as $book)
        <div class="card issued-book-card shadow-sm">
            {{-- Book Image --}}
            @if($book->image)
                <a href="{{ route('books.show', $book->id) }}">
                    <img src="{{ asset('images/' . basename($book->image)) }}" 
                         class="card-img-top" 
                         alt="{{ $book->title }}" 
                         style="height: 200px; object-fit: cover;">
                </a>
            @else
                <a href="{{ route('books.show', $book->id) }}">
                    <img src="{{ asset('images/CoverNotAvailable.jpg') }}" 
                         class="card-img-top" 
                         alt="Default Book" 
                         style="height: 200px; object-fit: cover;">
                </a>
            @endif

            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text text-muted mb-1">
                    <small><strong>Issued on:</strong> {{ \Carbon\Carbon::parse($book->pivot->issued_date)->format('M d, Y') }}</small>
                </p>
                <p class="card-text text-muted mb-3">
                    <small><strong>Return by:</strong> {{ \Carbon\Carbon::parse($book->pivot->return_date)->format('M d, Y') }}</small>
                </p>
                <div class="mt-auto text-center">
                    <form action="{{ route('books.return', $book->pivot->book_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-success btn-sm">Return Book</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>


@endif

    @endif

{{-- Cart Section --}}
<div class="cart-section mt-5">
    <h3 class="cart-title text-center mb-3">Your Cart</h3>

    @if($cartBooks->isEmpty())
        <p class="text-center text-muted">Your cart is empty.</p>
    @else
        <div class="cart-container">
            @foreach($cartBooks as $book)
                <div class="cart-item d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('images/' . basename($book->image ?? 'CoverNotAvailable.jpg')) }}"
                             alt="{{ $book->title }}"
                             style="width: 70px; height: 90px; object-fit: cover; border-radius: 6px;">
                        <div>
                            <div class="cart-book-title">{{ $book->title }}</div>
                            <div class="text-muted small">by {{ $book->author ?? 'Unknown' }}</div>
                        </div>
                    </div>

                    <div class="text-end ms-auto me-3">
                        <div class="fw-semibold">Unit: ${{ number_format($book->price ?? 0, 2) }}</div>
                        <div class="text-muted small">
                            Line total:
                            ${{ number_format(($book->price ?? 0) * ($book->pivot->quantity ?? 1), 2) }}
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <form action="{{ route('cart.update', $book->id) }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            <input type="number"
                                   name="quantity"
                                   value="{{ $book->pivot->quantity ?? 1 }}"
                                   min="1"
                                   class="form-control form-control-sm"
                                   style="width: 80px;">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                        </form>

                        <form action="{{ route('cart.remove', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Checkout Summary --}}
        <div class="bg-image">
        <div class="checkout-summary mt-4">
            <h5 class="mb-3">Checkout Summary</h5>

            <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>${{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Delivery</span>
                <span>${{ number_format($delivery, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Website Service Charge</span>
                <span>${{ number_format($serviceFee, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span>Discount</span>
                <span>- ${{ number_format($discount, 2) }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between fw-bold">
                <span>Payable Total</span>
                <span>${{ number_format($payableTotal, 2) }}</span>
            </div>

            {{-- Coupon --}}
            <form action="{{ route('cart.coupon') }}" method="POST" class="mt-3 d-flex gap-2">
                @csrf
                <input type="text" name="code" value="{{ $couponCode }}" class="form-control" placeholder="Enter coupon (try SAVE10)">
                <button class="btn btn-outline-secondary">Apply</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('checkout') }}" class="btn-success">Proceed to Checkout</a>
            </div>
        </div>
    @endif
</div>
</div>
<h3 class="section-title text-center mt-5 mb-3">My Orders</h3>

@if(!$orders->isEmpty())
    <div class="text-center mb-4">
        <form action="{{ route('orders.clear') }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to clear all order history?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Clear Order History
            </button>
        </form>
    </div>
@endif

@if($orders->isEmpty())
    <p class="text-center text-muted mt-4">You have no orders yet.</p>
@else
    @foreach($orders as $order)
        <div class="order-card shadow-sm p-3 mb-4 rounded">
            {{-- Order Info --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <div class="fw-semibold">Order #{{ $order->id }}</div>
                    <div class="text-muted small">Placed {{ $order->created_at->format('M d, Y') }}</div>
                </div>
                <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
            </div>

            {{-- Order Status --}}
            <div class="mb-3 small text-muted">
                @if($order->status === 'confirmed') ✅ Order confirmed
                @elseif($order->status === 'shipping') 🚚 Delivery in progress
                @elseif($order->status === 'delivered') 📦 Delivered
                @endif
            </div>
{{-- Books in this order --}}
<div class="order-books-container mt-3">
    @foreach($order->books as $book)
        <div class="order-book-card">
            {{-- Book Image --}}
            @if($book->image)
                <a href="{{ route('books.show', $book->id) }}">
                    <img src="{{ asset('images/' . basename($book->image)) }}" 
                         alt="{{ $book->title }}"
                         class="order-book-img">
                </a>
            @else
                <a href="{{ route('books.show', $book->id) }}">
                    <img src="{{ asset('images/CoverNotAvailable.jpg') }}" 
                         alt="Default Book"
                         class="order-book-img">
                </a>
            @endif

            <div class="order-book-info">
                <h6 class="mb-1">{{ $book->title }}</h6>
                <p class="text-muted small mb-1">Qty: {{ $book->pivot->quantity }}</p>
                <p class="fw-semibold small">Price: ${{ $book->pivot->price }}</p>
            </div>
        </div>
    @endforeach
</div>

        </div>
    @endforeach
@endif

@endsection
