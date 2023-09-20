@include('composants.head')

@include('composants.notification')

@if($identifiant)
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
            <label>Nouveau mot de passe *</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="element-formulaire">
            <label>Nouveau mot de passe confirmation *</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
            @error('password_confirmation')
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
@else
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
@endif
@include('composants.footer')