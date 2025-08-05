<!-- resources/views/books/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $book->title }} - Simple Shelf</title>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
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


<main class="main-content" style="display: flex; gap: 40px; padding: 40px;">
    <section class="book-info" style="flex: 2;">
        <h2>{{ $book->title }}</h2>
        <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" style="height:200px; width: 140px">
        <p>{{ $book->description }}</p>
        <p><strong>Rating:</strong> {{ number_format($book->rating, 1) }}/5</p>

        <h4>Reviews:</h4>
        <ul>
            @if($book->reviews && is_array(json_decode($book->reviews, true)))
                @foreach(json_decode($book->reviews, true) as $review)
                    <li>{{ $review }}</li>
                @endforeach
            @else
                <li>No reviews yet.</li>
            @endif
        </ul>
    </section>



    <aside class="recommendations" style="flex: 1;">
        <h3>Recommendations</h3>
        <div class="book-list">
            @foreach ($books as $recBook)
                @if ($recBook->id !== $book->id)
                    <div class="book-item">
                        <a href="{{ route('books.show', $recBook->id) }}">
                            <img src="{{ asset($recBook->image) }}" alt="{{ $recBook->title }}">
                        </a>
                        <div class="book-actions">
                            <a href="#" class="btn-buy">Buy</a>
                            <a href="#" class="btn-issue">Issue Book</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </aside>
</main>

<footer>
    <p>&copy; nirvana | Simple Shelf</p>
</footer>

</body>
</html>
