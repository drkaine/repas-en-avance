@include('composants.head')

@foreach($recettes as $recette)
    <div>
        {{  $recette->temps_preparation  }}
        {{  $recette->nom  }}
        {{  $recette->temps_cuisson  }}
        {{  $recette->temps_repos  }}
    </div>
    @foreach($recette->recuperationIngredient as $ingredient)
    <div>
        {{  $ingredient->nom  }}
    </div>
@endforeach
@endforeach


