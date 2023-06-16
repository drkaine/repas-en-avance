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
                <label for="regimes_alimentaires">Régime alimentaire</label>
                <select name="regimes_alimentaires" multiple>
                    @foreach($regimes_alimentaires as $regime_alimentaire)
                        <option value="{{  $regime_alimentaire->id  }}"{{  $regime_alimentaire->nom  }}</option>
                    @endforeach
                </select>
                @error('regimes_alimentaires')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit">Mettre à jour ses informations</button>
            </div>
        </form>

    </body>
</html>
