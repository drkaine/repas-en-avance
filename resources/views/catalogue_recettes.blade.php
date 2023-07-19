@include('composants.head')

<div class="liste-des-cartes">
    @foreach($recettes as $recette)
        <div>
            <div class="carte-recette">
                <img src="{{ asset('images/recettes/carotte.jpg') }}" alt="Description de l'image"  class="image-de-la-carte">
                <div class="texte-de-la-carte">
                    <h2 class="titre-de-la-carte">
                        {{  $recette->nom  }}
                    </h2>
                    <span>
                        <p>
                            Temps de préparation : {{  $recette->temps_preparation + $recette->temps_cuisson + $recette->temps_repos }} min
                        </p>
                    </span>
                    
                </div>
            </div>
            <div class="liste-des-ingreients">
                @foreach($recette->recuperationIngredient as $ingredient)
                    <div class="carte-ingredient">
                        {{  $ingredient->nom  }}
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>


