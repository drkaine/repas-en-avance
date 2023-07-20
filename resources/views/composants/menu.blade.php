<body>
    <header>
        <div class="menu-deroulant">
            <input type="checkbox" id="checkbox-menu-deroulant" />
            <label for="checkbox-menu-deroulant" class="icone-menu-deroulant">
                <span class="ligne"></span>
                <span class="ligne"></span>
                <span class="ligne"></span>
            </label>
            <ul class="liste-menu-deroulant">
                <li>
                    <a href="{{  route('accueil')  }}">Accueil</a>
                </li>
                <li>
                    <a href="{{  route('catalogue-recettes')  }}">Catalogue de recettes</a>
                </li>
                @auth
                    <li>
                        <a href="{{  route('ajout-tag')  }}">Ajout Tag</a>
                    </li>
                    <li>
                        <a href="{{  route('ajout-recette')  }}">Ajout Recette</a>
                    </li>
                    <li>
                        <a href="{{  route('mon-compte')  }}">Mon compte</a>
                    </li>
                    <li>
                        <a href="{{  route('deconnexion')  }}">Déconnexion</a>
                    </li>
                @else
                    <li>
                        <a href="{{  route('inscription')  }}">Inscription</a>
                    </li>
                    <li>
                        <a href="{{  route('connexion')  }}">Connexion</a>
                    </li>
                @endauth
            </ul>
        </div>

    </header>
