@foreach($recettes as $recette)
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
                @auth
                    <icon>
                        <form method="POST" action="{{ route('ajout-carnet-recettes') }}">
                            @csrf
                            <input type="hidden" name="id_user" value="{{  $recette->id  }}">
    
                            <input type="hidden" name="id_recette" value="{{ Auth::user()->id }}">

                            <button>
                                Ajout au carnet de recettes
                            </button>
                        </form>
                    </icon>

                    <icon>
                        <form method="POST" action="{{ route('suppression-carnet-recettes') }}">
                            @csrf
                            <input type="hidden" name="id_user" value="{{  $recette->id  }}">
    
                            <input type="hidden" name="id_recette" value="{{ Auth::user()->id }}">

                            <button>
                                Suppression du carnet de recettes
                            </button>
                        </form>
                    </icon>
                @endauth
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