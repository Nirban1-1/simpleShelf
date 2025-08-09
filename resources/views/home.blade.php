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
        <li><a href="#">My Profile</a></li>
        <li><a href="#">My Orders</a></li>
        <li><a href="#">Issue Book</a></li>
      </ul>

      <ul class="navbar-right">
        <li>
            <form action="#" method="GET" style="display: inline;">
            <input type="text" name="search" placeholder="Search"
            style="padding: 5px 12px; border-radius: 16px; border: 1px solid #ccc; font-size: 12px; width: 120px;">

            </form>
        </li>
        <li><a href="{{ url('/login') }}">Login</a></li>
        <li><a href="{{ url('/register') }}">Sign Up</a></li>
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
                <span> 10% cashback with SIM10</span>
                <span> 20% off with bank cards</span>
                <span> Buy 2 get 1 free on audiobooks!</span>
                <span> Free delivery over $30</span>
                <span> Monthly audiobook pass @ $5</span>
                <span> Flash Sale: Up to 30% off!</span>

                <!-- Duplicate for seamless scroll -->
                <span> 10% cashback with SIM10</span>
                <span> 20% off with bank cards</span>
                <span> Buy 2 get 1 free on audiobooks!</span>
                <span> Free delivery over $30</span>
                <span> Monthly audiobook pass @ $5</span>
                <span> Flash Sale: Up to 30% off!</span>
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
                    <div class="book-actions">
                        <a href="#" class="btn-buy">Buy</a>
                        <a href="#" class="btn-issue">Issue Book</a>
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
                    <div class="book-actions">
                        <a href="#" class="btn-buy">Buy</a>
                        <a href="#" class="btn-issue">Issue Book</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; nirvana | Simple Shelf</p>
    </footer>

</body>
</html>
