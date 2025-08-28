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


    <main>
        @yield('content')
    </main>

    
        <!-- Footer -->
    <footer>
        <p>&copy; nirvana | Simple Shelf</p>
    </footer>

</body>
</html>
