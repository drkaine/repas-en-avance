@include('composants.head')

@foreach($recettes as $recette)
    <div>
        {{  $recette->temps_preparation  }}
        {{  $recette->nom  }}
        {{  $recette->temps_cuisson  }}
        {{  $recette->temps_repos  }}
        {{  $recette->lien  }}
        {{  $recette->instruction  }}
        {{  $recette->description  }}
        {{  $recette->reference_livre  }}
    </div>
@endforeach
