"use strict";

function themeDePreference(theme) {
    var mediaQuery = "(prefers-color-scheme: ".concat(theme, ")");
    return window.matchMedia(mediaQuery).matches;
}

function basculeSurTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
}

function recupererLeTheme(theme) {
    var dataTheme = document.documentElement.getAttribute('data-theme');
    return dataTheme === theme;
}

function afficherIcone(iconeAModifier) {
    var icone = document.getElementById(iconeAModifier);
    icone.style.display = 'inline';
}

function dissimulerIcone(iconeAModifier) {
    var icone = document.getElementById(iconeAModifier);
    icone.style.display = 'none';
}

function mettreEnPlaceLeTheme() {
    if (themeDePreference('light')) {
        basculeSurTheme('light');
    }
    else {
        basculeSurTheme('dark');
    }
}

function afficherIconeSelonTheme() {
    if (recupererLeTheme('dark')) {
        afficherIcone('iconeSoleil');
        dissimulerIcone('iconeLune');
    }
    else {
        afficherIcone('iconeLune');
        dissimulerIcone('iconeSoleil');
    }
}

function changeurDeThemeAuClick() {
    var changeurDeTheme = document.getElementById('changeur-de-theme');
    changeurDeTheme.addEventListener('click', function () {
        var dataTheme = document.documentElement.getAttribute('data-theme');
        if (dataTheme === 'dark') {
            basculeSurTheme('light');
        }
        else {
            basculeSurTheme('dark');
        }
        afficherIconeSelonTheme();
    });
}

