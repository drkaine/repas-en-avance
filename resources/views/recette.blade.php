@include('composants.head')

<div>
    <div class="carte-recette">
    @foreach($recette->recuperationPhoto as $photo)
        <img src="{{ asset($photo->dossier . $photo->nom . '.jpeg') }}" alt="{{  $photo->description  }}"  class="image-de-la-carte">
    @endforeach
    
        <div class="texte-de-la-carte">
            <h2 class="titre-de-la-carte">
                {{  $recette->nom  }}
                {{  $recette->instruction  }}
                {{  $recette->description  }}
                {{  $recette->lien  }}
                {{  $recette->reference_livre  }}
            </h2>
            <span>
                <p>
                    Temps de préparation : {{  $recette->temps_preparation }} min
                    Temps de repos : {{  $recette->temps_cuisson  }} min
                    Temps cuisson : {{  $recette->temps_repos  }}
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

@include('composants.footer')