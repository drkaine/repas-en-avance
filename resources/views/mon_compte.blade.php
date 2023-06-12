@include('composants.head')

        <div>
            <a href="{{ route('anonymisation_du_compte') }}">Supprimer mon compte</a>
        </div>

        <form method="POST" action="{{ route('mon_compte') }}">
            @csrf

            <div>
                <label for="email">Adresse e-mail</label>
                <input id="email" type="email" name="email" value="{{  $user->email  }}" required autofocus>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="nom">Nom</label>
                <input id="nom" type="text" name="nom" value="{{  $user->nom  }}" required>
                @error('nom')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit">Mettre à jour ses informations</button>
            </div>
        </form>

    </body>
</html>
