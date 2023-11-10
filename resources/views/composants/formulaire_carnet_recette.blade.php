@auth
    @if(!in_array($recette->id ,$recette_ajoutee))
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
    @else
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
    @endif
@endauth