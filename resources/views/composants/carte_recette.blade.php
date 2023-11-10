@foreach($recettes as $recette)
    @include('composants.formulaire_carnet_recette')
    <div>
        <div class="carte-recette">
        @foreach($recette->recuperationPhoto as $photo)
            <a href="{{  route('recette', ['nom_recette' => $recette->url])  }}">
                <img src="{{ asset($photo->dossier . $photo->nom . '.jpeg') }}" alt="{{  $photo->description  }}"  class="image-de-la-carte">
            </a>
        @endforeach
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
        <div class="liste-des-ingredients">
            @foreach($recette->recuperationIngredient as $ingredient)
                <div class="carte-ingredient">
                    {{  $ingredient->nom  }}
                </div>
            @endforeach
        </div>
    </div>
@endforeach