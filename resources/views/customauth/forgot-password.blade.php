@php
    View::share('title', 'Forgot Password - ' . config('app.name'));
@endphp

@include('welcomecomponent.header')

<!-- Main Content Area -->
<main class="main-content">
    <div class="content-card">
        <main class="form-signin w-100 m-auto">

            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-muted mb-4">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-floating">
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror rounded" placeholder="name@example.com"
                        value="{{ old('email') }}" required>
                    <label for="email">{{ __('Email address') }}</label>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </main>
    </div>
</main>

@include('welcomecomponent.footer')
