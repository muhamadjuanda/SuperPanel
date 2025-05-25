@php
    View::share('title', 'Verify Email - ' . config('app.name'));
@endphp

@include('welcomecomponent.header')

<!-- Main Content Area -->
<main class="main-content">
    <div class="content-card">
        <main class="form-signin w-100 m-auto">

            <div class="text-muted mb-4 text-sm">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success mb-4 text-sm">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-4">
                <!-- Resend Verification Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none text-muted">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </main>
    </div>
</main>

@include('welcomecomponent.footer')
