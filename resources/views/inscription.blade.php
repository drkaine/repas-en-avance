@include('composants.head')

@include('composants.notification')

<form method="POST" action="{{ route('inscription') }}" class="formulaire">
    @csrf

    <div class="element-formulaire">
        <label>Adresse e-mail *</label>
        <input id="email" type="email" name="email" value="" required autofocus>
        @error('email')
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
        <label>Mot de passe confirmation *</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
        @error('password_confirmation')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Nom *</label>
        <input id="nom" type="text" name="nom" required>
        @error('nom')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>
            <a href="#modal-regimes-alimentaires" class="lien-modal">
                Régimes alimentaires
            </a>
        </label>
        <div id="modal-regimes-alimentaires" class="modal">
            <div class="contenu-modal">
                <select name="regimes_alimentaires[]" multiple>
                    @foreach($regimes_alimentaires as $regime_alimentaire)
                        <option value="{{  $regime_alimentaire->id  }}">{{  $regime_alimentaire->nom  }}</option>
                    @endforeach
                </select>
                @error('regimes_alimentaires')
                    <span>{{ $message }}</span>
                @enderror
                <a href="#fermeture" class="fermeture-modal">Fermer</a>
            </div>
        </div>
    </div>

    <div class="element-formulaire">
        <button type="submit" class="bouton-formulaire">
            S'inscrire
        </button>
    </div>

    <span>
        Les champs avec une * sont obligatoire
    </span>
</form>
@include('composants.footer')