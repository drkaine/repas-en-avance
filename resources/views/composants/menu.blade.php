<body>
    <header class="en-tete">
        <div class="menu-deroulant">
            <input type="checkbox" id="checkbox-menu-deroulant" />
            <label for="checkbox-menu-deroulant" class="icone-menu-deroulant">
                <span class="ligne"></span>
                <span class="ligne"></span>
                <span class="ligne"></span>
            </label>
            <ul class="liste-menu-deroulant">
                @guest
                    <li>
                        <a href="{{  route('inscription')  }}">Inscription</a>
                    </li>
                    <li>
                        <a href="{{  route('connexion')  }}">Connexion</a>
                    </li>
                @endauth
                @auth
                    <li>
                        <a href="{{  route('deconnexion')  }}">Déconnexion</a>
                    </li>
                    <li>
                        <a href="{{  route('ajout-tag')  }}">Ajout Tag</a>
                    </li>
                    <li>
                        <a href="{{  route('ajout-recette')  }}">Ajout Recette</a>
                    </li>
                    <li>
                        <a href="{{  route('mon-compte')  }}">Mon compte</a>
                    </li>
                @endauth
                <li>
                    <a href="{{  route('catalogue-recettes')  }}">Catalogue de recettes</a>
                </li>
            </ul>
        </div>
        <h1 class="titre-en-tete">
            <a href="{{  route('accueil')  }}">
                Repas en avance
            </a>
        </h1>
        <button id="changeur-de-theme" class="changeur-de-theme">
            <i class="far fa-sun" id="iconeSoleil"></i>
            <i class="fa-solid fa-moon" id="iconeLune"></i>
        </button>
    </header>
