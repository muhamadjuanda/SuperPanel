@php
    View::share('title', 'Welcome - ' . config('app.name'));
@endphp

@include('welcomecomponent.header')

<!-- Main Content Area -->
<main class="main-content">
    <div class="content-card">
        <!-- WELCOME PAGE CONTENT (Replace this section for login/register) -->
        <div class="welcome-content">
            <h1 id="typing-ios" class="ios-typing">Welcome</h1>
            <p class="lead">Simple admin template starter built with Laravel Breeze & Bootstrap 5</p>

            <div class="btn-group-custom">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-custom">
                        Dashboard
                    </a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-primary btn-custom">
                            Sign In
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-custom">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</main>

@include('welcomecomponent.footer')
