@php
    View::share('title', 'Confirm Password - ' . config('app.name'));
@endphp

@include('welcomecomponent.header')

<main class="main-content">
    <div class="content-card">
        <main class="form-signin w-100 m-auto">

            <p class="text-muted mb-4">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-floating">
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror rounded" placeholder="********"
                        required autocomplete="current-password">
                    <label for="password">{{ __('Password') }}</label>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        {{ __('Confirm') }}
                    </button>
                </div>
            </form>
        </main>
    </div>
</main>

@include('welcomecomponent.footer')
