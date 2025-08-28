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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('book-search');
    const results = document.getElementById('search-results');

    let timer;

    input.addEventListener('keyup', function() {
        const query = this.value;

        clearTimeout(timer);

        if (query.length < 2) {
            results.style.display = 'none';
            return;
        }

        timer = setTimeout(() => {
            fetch(`/books/autocomplete?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    results.innerHTML = '';
                    if (data.length === 0) {
                        results.style.display = 'none';
                        return;
                    }

                    data.forEach(book => {
                        const li = document.createElement('li');
                        li.textContent = book.title;
                        li.style.padding = '8px';
                        li.style.cursor = 'pointer';
                        li.addEventListener('click', () => {
                            window.location.href = `/books/${book.id}`;
                        });
                        results.appendChild(li);
                    });

                    results.style.display = 'block';
                });
        }, 300); // wait 300ms after typing
    });

    // Hide dropdown if clicked outside
    document.addEventListener('click', function(e) {
        if (!input.contains(e.target) && !results.contains(e.target)) {
            results.style.display = 'none';
        }
    });
});
</script>

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
            
        
        
        <form action="{{ route('books.search') }}" method="GET" style="position:relative;">
    <input type="text" name="query" id="book-search" placeholder="Search books..." autocomplete="off">
    <button type="submit" style="display:none;">Search</button>

    <ul id="search-results" style="
        position:absolute;
        top:100%;
        left:0;
        right:0;
        background:white;
        border:1px solid #ccc;
        list-style:none;
        margin:0;
        padding:0;
        z-index:1000;
        display:none;
        max-height:200px;
        overflow-y:auto;
    "></ul>
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


    <main>
        @yield('content')
    </main>

    
        <!-- Footer -->
    <footer>
        <p>&copy; nirvana | Simple Shelf</p>
    </footer>

</body>
</html>
