@php
    View::share('title', 'Login - ' . config('app.name'));
@endphp

@include('welcomecomponent.header')

<!-- Main Content Area -->
<main class="main-content">
    <div class="content-card">
        <!-- Original Login Form Content -->
        <main class="form-signin w-100 m-auto">
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                <!-- Email Address -->
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror rounded-top"
                        id="floatingInput" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                        required autocomplete="username">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror rounded-bottom"
                        id="floatingPassword" name="password" placeholder="Password" required
                        autocomplete="current-password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-check text-start my-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>

                <!-- Submit Button -->
                <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="text-center mt-3">
                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    </div>
                @endif

                <p class="mt-5 mb-3 text-body-secondary">&copy; {{ date('Y') }}
                    {{ config('app.name', 'Laravel') }}
                </p>
            </form>
        </main>
    </div>
</main>

@include('welcomecomponent.footer')
