@if(isset($reponse_json))
    <span class="formulaire-valide" id="message-de-reussite">
        {{ $reponse_json->message }}
    </span>

    <script src="{{ asset('js/gestion-des-notifications-de-formulaire.js') }}"></script>
    <script>
        cacherNotificationApresDelai('message-de-reussite', 5000);
    </script>
@endif