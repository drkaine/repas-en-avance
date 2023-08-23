export function cacherNotificationApresDelai(span_id: string, delai: number) : void {
    const span_element = document.getElementById(span_id);
    if (span_element) {
      setTimeout(() => {
        span_element.style.display = 'none';
      }, delai);
    }
}