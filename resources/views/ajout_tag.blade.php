@include('composants.head')

<form method="POST" action="{{ route('ajout-tag') }}" class="formulaire">
    @csrf

    <div class="element-formulaire">
        <label for="nom">Nom</label>
        <input id="nom" type="text" name="nom"required autofocus>
        @error('nom')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label for="tags_parent">Tag parent</label>
        <select name="tags_parent[]" multiple>
            @foreach($tags as $tag)
                <option value="{{  $tag->id  }}">{{  $tag->nom  }}</option>
            @endforeach
        </select>
        @error('tags_parent')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label for="tags_enfant">Tag enfant</label>
        <select name="tags_enfant[]" multiple>
            @foreach($tags as $tag)
                <option value="{{  $tag->id  }}">{{  $tag->nom  }}</option>
            @endforeach
        </select>
        @error('tags_enfant')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <button type="submit" class="bouton-formulaire">
            Ajouter un tag
        </button>
    </div>
</form>
