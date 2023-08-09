export function pasDePreference (): boolean {
    return window.matchMedia('(prefers-color-scheme: no-preference)').matches;
}

export function basculeSurThemeSombre (): void {
    document.documentElement.setAttribute('data-theme', 'dark');
}