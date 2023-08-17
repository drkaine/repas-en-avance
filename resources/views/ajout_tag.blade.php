@include('composants.head')

<form method="POST" action="{{ route('ajout-tag') }}" class="formulaire">
    @csrf

    <div class="element-formulaire">
        <label for="nom">Nom *</label>
        <input id="nom" type="text" name="nom"required autofocus>
        @error('nom')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label for="tags_enfant">
            <a href="#modal-tags-parent" class="lien-modal">
                Tag parents
            </a>
        </label>
        <div id="modal-tags-parent" class="modal">
            <div class="contenu-modal">
                <select name="tags_enfant[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{  $tag->id  }}">{{  $tag->nom  }}</option>
                    @endforeach
                </select>
                @error('tags_enfant')
                    <span>{{ $message }}</span>
                @enderror
                <a href="#fermeture" class="fermeture-modal">Fermer</a>
            </div>
        </div>
    </div>

    <div class="element-formulaire">
        <label for="tags_enfant">
            <a href="#modal-tags-enfant" class="lien-modal">
                Tag enfants
            </a>
        </label>
        <div id="modal-tags-enfant" class="modal">
            <div class="contenu-modal">
                <select name="tags_enfant[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{  $tag->id  }}">{{  $tag->nom  }}</option>
                    @endforeach
                </select>
                @error('tags_enfant')
                    <span>{{ $message }}</span>
                @enderror
                <a href="#fermeture" class="fermeture-modal">Fermer</a>
            </div>
        </div>
    </div>

    <div class="element-formulaire">
        <button type="submit" class="bouton-formulaire">
            Ajouter un tag
        </button>
    </div>

    <span>
        Les champs avec une * sont obligatoire
    </span>
</form>
@include('composants.footer')