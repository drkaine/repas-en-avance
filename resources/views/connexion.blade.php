@include('composants.head')
<form method="POST" action="{{ route('connexion') }}" class="formulaire">
    @csrf

    <div class="element-formulaire">
        <label for="email">Adresse e-mail *</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label for="password">Mot de passe *</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label for="remember">Se souvenir de moi</label>
        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    </div>

    <div class="element-formulaire">
        <button type="submit" class="bouton-formulaire">
            Se connecter
        </button>
    </div>

    <span>
        Les champs avec une * sont obligatoire
    </span>
</form>
@include('composants.footer')