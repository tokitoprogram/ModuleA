
<x-basic>
    <form method="POST" action="{{ route('registration.attempt') }}">
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
        <button type="submit">Зарегистрироваться</button>
    </form>
</x-basic>

