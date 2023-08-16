export function themeDePreference (theme: 'dark' | 'light' | 'no-preference'): boolean {
    const mediaQuery = `(prefers-color-scheme: ${theme})`;
    return window.matchMedia(mediaQuery).matches;
}

export function basculeSurTheme (theme: 'dark' | 'light'): void {
    document.documentElement.setAttribute('data-theme', theme);
}
