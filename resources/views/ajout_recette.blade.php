@include('composants.head')

<form method="POST" action="{{ route('ajout_recette') }}">
    @csrf

    <div>
        <label for="nom">Nom de la recette</label>
        <input id="nom" type="text" name="nom" required autofocus>
        @error('nom')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="lien">Lien de la recette</label>
        <input id="lien" type="text" name="lien">
        @error('lien')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="reference_livre">Référence du livre</label>
        <input id="reference_livre" type="text" name="reference_livre">
        @error('reference_livre')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="instruction">Instruction</label>
        <input id="instruction" type="text" name="instruction">
        @error('instruction')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <input id="description" type="text" name="description">
        @error('description')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="temps_preparation">Temps de la preparation</label>
        <input id="temps_preparation" type="number" name="temps_preparation" required>
        <span>min</span>
        @error('temps_preparation')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="temps_cuisson">Temps de cuisson</label>
        <input id="temps_cuisson" type="number" name="temps_cuisson">
        <span>min</span>
        @error('temps_cuisson')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="temps_repos">temps de repos</label>
        <input id="temps_repos" type="number" name="temps_repos">
        <span>min</span>
        @error('temps_repos')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="submit">Ajouter la recette</button>
    </div>
</form>
