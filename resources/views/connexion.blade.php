@include('composants.head')
<form method="POST" action="{{ route('connexion') }}">
    @csrf

    <div>
        <label for="email">Adresse e-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">Se souvenir de moi</label>
    </div>

    <div>
        <button type="submit">Se connecter</button>
    </div>
</form>
