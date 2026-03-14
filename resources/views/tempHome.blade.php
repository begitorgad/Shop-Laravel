<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <h1>{{ $title }}</h1>
</head>
<body>
    @if ($status === 'open')
        <p>Welcome to our shop! We are open for business.</p>
    @else
        <p>Sorry, we are currently closed. Please come back later.</p>
    @endif
    <p>There's {{ $nbProducts }} products in our shop and it is currently {{ $status }}.</p>
</body>
</html>