<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Repas en avance</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

        <script src="{{ asset('js/changeur-de-theme.js') }}"></script>

        <script>
            if (pasDeThemeDePreference()) {
                basculeSurThemeSombre();
            }
        </script>

    </head>
    @include('composants.menu')
