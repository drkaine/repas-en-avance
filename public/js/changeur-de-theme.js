"use strict";
function pasDeThemeDePreference() {
    return window.matchMedia('(prefers-color-scheme: no-preference)').matches;
}
function basculeSurThemeSombre() {
    document.documentElement.setAttribute('data-theme', 'dark');
}
function basculeSurThemeClair() {
    document.documentElement.setAttribute('data-theme', 'light');
}