export function redirectionVers(url: string, delai: number) : void {
    setTimeout(() => {
        window.location.replace(url);
    }, delai);
}