<x-layout>
    <div class="container mt-5">
        <h1>Welcome to Admin Dashboard 🎓</h1>
        <p>You are logged in as <strong>{{ Auth::user()->name }}</strong></p>
        <p>Role: <strong>{{ Auth::user()->role }}</strong></p>
        
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn btn-danger">
           Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</x-layout>