@include('composants.head')

<form method="POST" action="{{ route('ajout_tag') }}">
    @csrf

    <div>
        <label for="tag">Nom</label>
        <input id="tag" type="text" name="tag"required autofocus>
        @error('tag')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="tags">Tags assossié</label>
        <select name="tags" multiple>
            @foreach($tags as $tag)
                <option value="{{  $tag->nom  }}">{{  $tag->nom  }}</option>
            @endforeach
        </select>
        @error('tags')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="submit">Ajouter un tag</button>
    </div>
</form>
