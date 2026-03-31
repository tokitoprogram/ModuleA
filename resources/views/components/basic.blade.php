
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$attributes->get('pageName', 'Название страницы')}}</title>
    @vite(['resources/css/basic.css'])


</head>
<body>
    <x-layout.header/>
    <main>
        {{ $slot  }}
    </main>
</body>
</html>
