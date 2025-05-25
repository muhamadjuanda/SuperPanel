@php
    View::share('title', 'Register - ' . config('app.name'));
@endphp

@include('welcomecomponent.header')

<!-- Main Content Area -->
<main class="main-content">
    <div class="content-card">
        <form method="POST" action="{{ route('register') }}" class="form-auth">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Create your account</h1>

            <div class="form-floating">
                <input type="text" class="form-control @error('name') is-invalid @enderror rounded-top"
                    id="floatingName" name="name" value="{{ old('name') }}" placeholder="Full Name" required
                    autocomplete="name">
                <label for="floatingName">Full Name</label>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingEmail"
                    name="email" value="{{ old('email') }}" placeholder="name@example.com" required
                    autocomplete="username">
                <label for="floatingEmail">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="floatingPassword" name="password" placeholder="Password" required autocomplete="new-password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror rounded-bottom"
                    id="floatingPasswordConfirmation" name="password_confirmation" placeholder="Confirm Password"
                    required autocomplete="new-password">
                <label for="floatingPasswordConfirmation">Confirm Password</label>
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn btn-primary w-100 py-2 mt-4" type="submit">Create Account</button>

            <div class="text-center mt-3">
                <a class="text-decoration-none" href="{{ route('login') }}">
                    Already have an account? Sign in
                </a>
            </div>

            <p class="mt-5 mb-3 text-body-secondary">&copy; {{ date('Y') }}
                {{ config('app.name', 'Laravel') }}
            </p>
        </form>
    </div>
</main>

@include('welcomecomponent.footer')
