@include('composants.head')

@include('composants.notification')

<form method="POST" action="{{ route('ajout-recette') }}" class="formulaire">
    @csrf

    <div class="element-formulaire">
        <label>Nom de la recette *</label>
        <input id="nom" type="text" name="nom" required autofocus>
        @error('nom')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Lien de la recette</label>
        <input id="lien" type="text" name="lien">
        @error('lien')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Référence du livre</label>
        <input id="reference_livre" type="text" name="reference_livre">
        @error('reference_livre')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Instruction</label>
        <textarea id="instruction" name="instruction" rows="6" cols="30"></textarea>
        @error('instruction')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Description</label>
        <textarea id="description" name="description" rows="6" cols="30"></textarea>
        @error('description')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Temps de la preparation *</label>
        <input id="temps_preparation" type="number" name="temps_preparation" placeholder="min" required>
        @error('temps_preparation')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>Temps de cuisson</label>
        <input id="temps_cuisson" type="number" name="temps_cuisson" placeholder="min">
        @error('temps_cuisson')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>temps de repos</label>
        <input id="temps_repos" type="number" name="temps_repos" placeholder="min">
        @error('temps_repos')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div class="element-formulaire">
        <label>
            <a href="#modal-ustensiles" class="lien-modal">
                Ustensiles
            </a>
        </label>
        <div id="modal-ustensiles" class="modal">
            <div class="contenu-modal">
                <select name="ustensiles[]" multiple>
                    @foreach($ustensiles as $ustensile)
                        <option value="{{  $ustensile->id  }}">{{  $ustensile->nom  }}</option>
                    @endforeach
                </select>
                @error('ustensiles')
                    <span>{{ $message }}</span>
                @enderror
                <a href="#fermeture" class="fermeture-modal">Fermer</a>
            </div>
        </div>
    </div>

    <div class="element-formulaire">
        <label>
            <a href="#modal-mode-de-cuissons" class="lien-modal">
                Mode de cuissons
            </a>
        </label>
        <div id="modal-mode-de-cuissons" class="modal">
            <div class="contenu-modal">
                <select name="mode_de_cuissons[]" multiple>
                    @foreach($mode_de_cuissons as $mode_de_cuisson)
                        <option value="{{  $mode_de_cuisson->id  }}">{{  $mode_de_cuisson->nom  }}</option>
                    @endforeach
                </select>
                @error('mode_de_cuissons')
                    <span>{{ $message }}</span>
                @enderror
                <a href="#fermeture" class="fermeture-modal">Fermer</a>
            </div>
        </div>
    </div>

    <div class="element-formulaire">
        <label>
            <a href="#modal-ingredients" class="lien-modal">
                Ingredients *
            </a>    
        </label>
        <div id="modal-ingredients" class="modal">
            <div class="contenu-modal">
                <select name="ingredients[]" multiple required>
                    @foreach($ingredients as $ingredient)
                        <option value="{{  $ingredient->id  }}">{{  $ingredient->nom  }}</option>
                    @endforeach
                </select>
                @error('ingredients')
                    <span>{{ $message }}</span>
                @enderror

                <label>
                    quantitées
                </label>
                @foreach($ingredients as $ingredient)
                    <span>
                        {{  $ingredient->nom  }}
                    </span>
                    <input id="quantitees" type="text" name="quantitees[{{  $ingredient->id  }}]"  placeholder="quantitée et mesure" >
                @endforeach
                @error('quantitees')
                    <span>{{ $message }}</span>
                @enderror
                <a href="#fermeture" class="fermeture-modal">Fermer</a>
            </div>
        </div>
    </div>

    <div class="element-formulaire">
        <button type="submit" class="bouton-formulaire">
            Ajouter la recette
        </button>
    </div>

    <span>
        Les champs avec une * sont obligatoire
    </span>
</form>
@include('composants.footer')