<body>
    <header>
        <a href="{{  route('accueil')  }}">Accueil</a>
        @auth
            <a href="{{  route('ajout_tag')  }}">Ajout Tag</a>
            <a href="{{  route('ajout_recette')  }}">Ajout Recette</a>
            <a href="{{  route('mon_compte')  }}">Mon compte</a>
            <a href="{{  route('deconnexion')  }}">Déconnexion</a>
        @else
            <a href="{{  route('inscription')  }}">Inscription</a>
            <a href="{{  route('connexion')  }}">Connexion</a>
        @endauth
    </header>
