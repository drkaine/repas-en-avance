@include('composants.head')

@include('composants.notification')
<form method="POST" action="{{ route('accueil') }}" class="formulaire">
    @csrf

    <div class="element-formulaire">
        <label>Adresse e-mail *</label>
        <input id="email" type="email" name="email" value="" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <button type="submit" class="bouton-formulaire">
            Demander un lien pour changer son mot de passe
        </button>
    </div>

    <span>
        Les champs avec une * sont obligatoire
    </span>
</form>
@include('composants.footer')