<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
</head>
<body>
    <h1>About Us</h1>
    <h2>Name: {{ $name }}</h2>
    <h2>id: {{ $id }}</h2>

    @include('SubViews.Input')
</body>
</html>