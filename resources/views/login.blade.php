
<x-basic pageName="Вход">
<form method="POST" action="{{ route('login.attempt') }}">
    @csrf
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
                 @endforeach

            </ul>
        </div>
    @endif

    <input name="email" placeholder="Your Email" type="email"/>
    <input name="password" placeholder="Your Password" type="password"/>
    <button type="submit">Войти</button>
</form>
</x-basic>



