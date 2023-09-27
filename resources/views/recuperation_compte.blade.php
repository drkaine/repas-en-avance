@include('composants.head')

<form method="POST" action="{{ route('recuperation-compte') }}" class="formulaire">
    @csrf

    <div class="element-formulaire">
        <label>Code *</label>
        <input id="email_anonyme" type="email" name="email_anonyme" value="" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Adresse e-mail *</label>
        <input id="email" type="email" name="email" value="" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Nom *</label>
        <input id="nom" type="text" name="nom" value="" required autofocus>
        @error('nom')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Mot de passe *</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <button type="submit" class="bouton-formulaire">
            Changer le mot de passe
        </button>
    </div>

    <span>
        Les champs avec une * sont obligatoire
    </span>
</form>

@include('composants.footer')