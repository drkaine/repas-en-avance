@include('composants.head')

<p>
    Votre mail est bien confirmé,
    Vous allez être redirigé vers la page de connexion
</p>

<script src="{{  asset('js/gestion-de-redirection.js')  }}"></script>
<script>
    const url = "{{  route('accueil')  }}";
    redirectionVers(url, 10000);// 10 secondes
</script>
@include('composants.footer')