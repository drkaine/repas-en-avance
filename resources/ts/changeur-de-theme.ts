export function themeDePreference(theme: 'dark' | 'light' | 'no-preference'): boolean {
    const mediaQuery = `(prefers-color-scheme: ${theme})`;
    return window.matchMedia(mediaQuery).matches;
}

export function basculeSurTheme(theme: 'dark' | 'light'): void {
    document.documentElement.setAttribute('data-theme', theme);
}

export function recupererLeTheme(theme: 'dark' | 'light'): boolean {
    const dataTheme = document.documentElement.getAttribute('data-theme');
    return  dataTheme === theme;
}

export function afficherIcone(iconeAModifier: 'iconeSoleil' | 'iconeLune'): void {
    const icone = document.getElementById(iconeAModifier) as HTMLElement;
    icone.style.display = 'inline';
}

export function dissimulerIcone(iconeAModifier: 'iconeSoleil' | 'iconeLune'): void {
    const icone = document.getElementById(iconeAModifier) as HTMLElement;
    icone.style.display = 'none';
}

export function mettreEnPlaceLeTheme(): void {
    if (themeDePreference('light')) {
        basculeSurTheme('light');
    } else {
        basculeSurTheme('dark');
    }
}

export function afficherIconeSelonTheme(): void {
    if(recupererLeTheme('dark')) {
        afficherIcone('iconeSoleil');
        dissimulerIcone('iconeLune');
    } else {
        afficherIcone('iconeLune');
        dissimulerIcone('iconeSoleil');
    }
}

export function changeurDeThemeAuClick(): void {
    const changeurDeTheme = document.getElementById('changeur-de-theme') as HTMLElement;

    changeurDeTheme.addEventListener('click', () => {

        const dataTheme = document.documentElement.getAttribute('data-theme');
        
        if(dataTheme === 'dark') {
            basculeSurTheme('light');
        } else {
            basculeSurTheme('dark');
        }
        
        afficherIconeSelonTheme();
    });
}
