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
        <li class="dropdown">
            <a href="#">Categories ▾</a>
            <ul class="dropdown-content">
                <li><a href="#">Comic</a></li>
                <li><a href="#">Romantic</a></li>
                <li><a href="#">Self Development</a></li>
                <li><a href="#">Science Fiction</a></li>
                <li><a href="#">Poetry</a></li>
                <li><a href="#">Adventure</a></li>
                <li><a href="#">Literature</a></li>
            </ul>
        </li>
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

        <!-- Book Actions -->
        <div class="book-actions" style="margin-top: 20px;">
                            
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
                        <div class="book-actions-wrapper">
                        <div class="price-overlay">Tk.{{ number_format($recBook->price, 2) }}</div>
                        <div class="book-actions">
                            
                        
                            <form action="{{ route('cart.add', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn-issue">Buy</button>
                            </form>

                            @guest
                                <a href="{{ route('login') }}" class="btn-issue" title="Login to issue books">Login to Issue</a>
                            @else
                                @if(Auth::user()->hasMembership())
                                    
                                
                                    <form action="{{ route('books.issue', $recBook->id) }}" method="POST" style="display:inline;" class="issue-form">
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
                @endif
            @endforeach
        </div>
    </aside>
</main>

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
