@include('composants.head')

<div>
    <a href="{{ route('anonymisation-du-compte') }}">Supprimer mon compte</a>
</div>

<div>
    <a href="{{ route('carnet-recettes') }}">Mon carnet de recettes</a>
</div>

<form method="POST" action="{{ route('modification-user') }}" class="formulaire">
    @csrf

    <div class="element-formulaire">
        <label>Adresse e-mail *</label>
        <input id="email" type="email" name="email" value="{{  $user->email  }}" required autofocus>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Nom *</label>
        <input id="nom" type="text" name="nom" value="{{  $user->nom  }}" required>
        @error('nom')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>
            <a href="#modal-tags-regimes-alimentaires" class="lien-modal">
                Régimes alimentaires
            </a>
        </label>
        <div id="modal-tags-regimes-alimentaires" class="modal">
            <div class="contenu-modal">
                <select name="tags_regimes_alimentaires[]" multiple>
                    @foreach($tags_regimes_alimentaires as $tag_regime_alimentaire)
                        <option value="{{  $tag_regime_alimentaire->id  }}" @if(in_array($tag_regime_alimentaire->id, $regimes_alimentaires)) selected @endif>{{  $tag_regime_alimentaire->nom  }}</option>
                    @endforeach
                </select>
                @error('tags_regimes_alimentaires')
                    <span>{{ $message }}</span>
                @enderror
                <a href="#fermeture" class="fermeture-modal">Fermer</a>
            </div>
        </div>
    </div>

    <div class="element-formulaire">
        <button type="submit" class="bouton-formulaire">
            Mettre à jour ses informations
        </button>
    </div>

    <span>
        Les champs avec une * sont obligatoire
    </span>
</form>
@include('composants.footer')