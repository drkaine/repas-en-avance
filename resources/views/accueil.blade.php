@include('composants.head')

<div class="liste-des-cartes">
    @include('composants.carte_recette', ['recettes' => $recettes])
</div>

@include('composants.footer')