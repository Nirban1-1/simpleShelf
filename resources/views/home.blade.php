<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Shelf</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
      <ul class="navbar-left">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Category</a></li>
        <li><a href="{{ route('profiledetails.show') }}">My Profile</a></li>
        <li><a href="{{ route('orders.index') }}">My Orders</a></li>
      </ul>

      <ul class="navbar-right">
        <li>
            <form action="#" method="GET" style="display: inline;">
            <input type="text" name="search" placeholder="Search"
            style="padding: 5px 12px; border-radius: 16px; border: 1px solid #ccc; font-size: 12px; width: 120px;">
            </form>
        </li>
        @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Sign Up</a></li>
        @endguest

        @auth
            <li>Welcome, {{ Auth::user()->name }}</li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none; border:none; cursor:pointer; color:#007bff; padding:0;">Logout</button>
                </form>
            </li>
        @endauth
      </ul>
    </nav>

    <!-- Headline -->
    <header class="headline">
        <h1>Simple Shelf</h1>
    </header>

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

    <!-- Footer -->
    <footer>
        <p>&copy; nirvana | Simple Shelf</p>
    </footer>

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

</body>
</html>
