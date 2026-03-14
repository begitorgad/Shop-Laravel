<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
</head>
<body>
    <h1>Page Not Found</h1>
    <p>You will be redirected to the home page in 5 seconds...</p>
    <a href="{{ route('home') }}">Go Home Now</a>

    <script>
        setTimeout(function() {
            window.location.href = '{{ route("home") }}';
        }, 5000);
    </script>
</body>
</html>