export function pasDeThemeDePreference (): boolean {
    return window.matchMedia('(prefers-color-scheme: no-preference)').matches;
}

export function basculeSurThemeSombre (): void {
    document.documentElement.setAttribute('data-theme', 'dark');
}

export function basculeSurThemeClair (): void {
    document.documentElement.setAttribute('data-theme', 'light');
}