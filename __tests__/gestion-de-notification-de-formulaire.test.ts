import {
    cacherNotificationApresDelai,
} from '../resources/ts/gestion-de-notification-de-formulaire.ts';

describe('cacherNotificationApresDelai', () => {
    it('Cache la notification après le délai spécifié', () => {
      document.body.innerHTML = '<span id="message-de-reussite"></span>';
      cacherNotificationApresDelai('message-de-reussite', 5000);// 5 secondes
      setTimeout(() => {
        const span_element = document.getElementById('message-de-reussite');
        expect(span_element?.style.display).toBe('none');
      }, 5000);
    });
});