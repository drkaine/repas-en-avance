@include('composants.head')

        <div>
            <form method="POST" action="{{ route('inscription') }}">
            @csrf

            <div>
                <label for="email">Adresse e-mail</label>
                <input id="email" type="email" name="email" value="" required autofocus>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password_confirmation">Mot de passe confirmation</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                @error('password_confirmation')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="nom">Nom</label>
                <input id="nom" type="text" name="nom" required>
                @error('nom')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="regimes_alimentaires">Régimes alimentaires</label>
                <select name="regimes_alimentaires[]" multiple>
                    @foreach($regimes_alimentaires as $regime_alimentaire)
                        <option value="{{  $regime_alimentaire->id  }}">{{  $regime_alimentaire->nom  }}</option>
                    @endforeach
                </select>
                @error('regimes_alimentaires')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit" class="bouton-formulaire">
                    S'inscrire
                </button>
            </div>
        </form>
        </div>
    </body>
</html>
