"use strict";

function themeDePreference(theme) {
    var mediaQuery = "(prefers-color-scheme: ".concat(theme, ")");
    return window.matchMedia(mediaQuery).matches;
}

function basculeSurTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
}

