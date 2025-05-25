@php
    View::share('title', ($code ?? 'Error') . ' - ' . config('app.name'));
@endphp

@include('welcomecomponent.header')

<main class="main-content">
    <div class="content-card text-center">
        <div class="welcome-content">
            <!-- Ikon Error -->
            <h1 class="text-danger mb-2">
                <i class="bi bi-x-circle"></i>
            </h1>

            <!-- Error Code -->
            <h1 class="display-4 text-secondary">{{ $code ?? 'Error' }}</h1>

            <!-- Error Message -->
            <p class="lead text" style="font-size: 1.5rem">
                {{ $message ?? 'Something went wrong.' }}
            </p>

            <!-- Description -->
            <p class="text-muted">
                {{ $description ?? 'Please try again later or contact support if the issue persists.' }}
            </p>

            <!-- Button Group -->
            <div class="btn-group-custom mt-4">
                <a href="{{ url('/') }}"
                    class="btn btn-primary btn-custom d-flex align-items-center justify-content-center">
                    <i class="bi bi-house-door-fill me-2"></i> Go Home
                </a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-custom">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </div>
</main>


@include('welcomecomponent.footer')
