<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
</head>
<body>
    {{--

    this -s a comment
    
    --}}

    
    <h1>Contact Us</h1>
    <h2>Name: {{ request()->name }}</h2>
    <h2>Email: {{ request()->id }}</h2>

    @for ($i = 0; $i < 10; $i++)
        <p>{{ $i }}</p>

        @if($i==5)
            <h1>Say Hi is {{$i}}</h1>
        @endif
    @endfor
</body>
</html>