@include('composants.head')

@foreach($recettes as $recette)
    <div>
        {{  $recette->nom  }}
        {{  $recette->temps_preparation  }} min
        {{  $recette->temps_cuisson  }} min
        {{  $recette->temps_repos  }} min
    
        @foreach($recette->recuperationIngredient as $ingredient)
        <div>
            {{  $ingredient->nom  }}
        </div>
    @endforeach
    </div>
@endforeach


