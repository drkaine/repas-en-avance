<body>
    <header>
        <a href="{{  route('accueil')  }}">Accueil</a>
        <a href="{{  route('catalogue-recettes')  }}">Catalogue de recettes</a>
        @auth
            <a href="{{  route('ajout-tag')  }}">Ajout Tag</a>
            <a href="{{  route('ajout-recette')  }}">Ajout Recette</a>
            <a href="{{  route('mon-compte')  }}">Mon compte</a>
            <a href="{{  route('deconnexion')  }}">Déconnexion</a>
        @else
            <a href="{{  route('inscription')  }}">Inscription</a>
            <a href="{{  route('connexion')  }}">Connexion</a>
        @endauth
    </header>
