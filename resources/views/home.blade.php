@extends('layouts.app')
@section('content')

    <!-- Scrolling Discounts -->
    <section class="discount-scroller">
        <div class="scroller-wrapper">
            <div class="scroller-content">
                <span> 10% off with SAVE10</span>
                <span> 20% off with T20</span>
                <span> 25% off with FLASH25</span>
                <span> Monthly Membership only at 500</span>
                <span> Flash Sale: Up to 30% off!</span>
                <span> Yearly Membership only at 1500</span>
                <!-- Duplicate for seamless scroll -->
                <span> 10% off with SAVE10</span>
                <span> 20% off with T20</span>
                <span> 25% off with FLASH25</span>
                <span> Monthly Membership only at 500</span>
                <span> Flash Sale: Up to 30% off!</span>
                <span> Yearly Membership only at 1500</span>
            </div>
        </div>
    </section>

    <!-- Reader's Choice -->
    <section class="section-block">
        <h2>Reader's Choice</h2>
        <div class="book-list">
            @foreach ($books as $book)
                <div class="book-item">
                    <a href="{{ route('books.show', $book->id) }}">
                        <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                    </a>
                    <div class="book-actions-wrapper">
                        <div class="price-overlay">Tk.{{ number_format($book->price, 2) }}</div>
                        <div class="book-actions">
                            
                        
                        
                            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-issue">Buy</button>
                            </form>

                            
                            @guest
                                <a href="{{ route('login') }}" class="btn-issue" title="Login to issue books">Login to Issue</a>
                            @else
                                @if(Auth::user()->hasMembership())



                                    <form action="{{ route('books.issue', $book->id) }}" method="POST" style="display:inline;" class="issue-form">
                                        @csrf
                                        <button type="submit" class="btn-issue" title="Issue this book">Issue Book</button>
                                    </form>



                                @else
                                    <a href="{{ route('orders.index') }}" class="btn-issue" title="Get membership to issue books">Issue Book</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Recommendations -->
    <section class="section-block">
        <h2>Recommendations</h2>
        <div class="book-list">
            @foreach ($books as $book)
                <div class="book-item">
                    <a href="{{ route('books.show', $book->id) }}">
                        <img src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                    </a>
                    <div class="book-actions-wrapper">
                        <div class="price-overlay">Tk.{{ number_format($book->price, 2) }}</div>
                        <div class="book-actions">
                            
                        
                            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-issue">Buy</button>
                            </form>


                            @guest
                                <a href="{{ route('login') }}" class="btn-issue" title="Login to issue books">Login to Issue</a>
                            @else
                                @if(Auth::user()->hasMembership())
                                    
                                
                                <form action="{{ route('books.issue', $book->id) }}" method="POST" style="display:inline;" class="issue-form">
                                        @csrf
                                        <button type="submit" class="btn-issue" title="Issue this book">Issue Book</button>
                                </form>

                                @else
                                    <a href="{{ route('orders.index') }}" class="btn-issue" title="Get membership to issue books">Issue Book</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>



    <script>
        // Add form submission debugging
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.issue-form');
            forms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    console.log('Form submitted:', form.action);
                    console.log('Form method:', form.method);
                    console.log('CSRF token:', form.querySelector('input[name="_token"]').value);
                });
            });
        });
    </script>

@endsection