@php
    View::share('title', 'Reset Password - ' . config('app.name'));
@endphp

@include('welcomecomponent.header')

<!-- Main Content Area -->
<main class="main-content">
    <div class="content-card">

        <main class="form-signin w-100 m-auto">

            <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

            @if ($errors->any())
                <div class="alert alert-danger mb-4" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <!-- Email Address -->
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror rounded-top"
                        id="floatingInput" name="email" value="{{ old('email', request()->email) }}"
                        placeholder="name@example.com" readonly required autocomplete="username">
                    <label for="floatingInput">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="floatingPassword" name="password" placeholder="New Password" required
                        autocomplete="new-password">
                    <label for="floatingPassword">New Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-floating">
                    <input type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror rounded-bottom"
                        id="floatingPasswordConfirm" name="password_confirmation" placeholder="Confirm Password"
                        required autocomplete="new-password">
                    <label for="floatingPasswordConfirm">Confirm Password</label>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Reset Password</button>

                <p class="mt-5 mb-3 text-body-secondary">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}
                </p>

            </form>

        </main>

    </div>
</main>

@include('welcomecomponent.footer')
