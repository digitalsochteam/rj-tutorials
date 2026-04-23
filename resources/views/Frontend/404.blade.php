@extends('Frontend.layout.main')

@section('content')
    <div class="container text-center" style="margin-top: 100px;">
        <h1 class="display-4">404 - Page Not Found</h1>
        <p class="lead">Sorry, the page you are looking for does not exist.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Go to Dashboard</a>
        <p class="mt-4">You will be redirected to the homepage in <span id="countdown">2</span> seconds.</p>
    </div>
    <script>
        let seconds = 2;
        const countdown = document.getElementById('countdown');
        const timer = setInterval(function () {
            seconds--;
            if (seconds > 0) {
                countdown.textContent = seconds;
            }
        }, 1000);

        setTimeout(function () {
            clearInterval(timer);
            window.location.href = '/';
        }, 2000);
    </script>
@endsection