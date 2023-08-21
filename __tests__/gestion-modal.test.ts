import {
    ouvertureModal,
    fermetureModal,
} from '../resources/ts/gestion-modal.ts'

describe('Gestion modal', () => {
  let fenetre_modal: HTMLDivElement;
  let contenu_modal: HTMLDivElement;

  beforeEach(() => {
    fenetre_modal = document.createElement('div');
    fenetre_modal.className = 'modal';

    contenu_modal = document.createElement('div');
    contenu_modal.className = 'contenu-modal';

    fenetre_modal.appendChild(contenu_modal);
    document.body.appendChild(fenetre_modal);
  });

  afterEach(() => {
    fenetre_modal.remove();
    contenu_modal.remove();
  });

  test('ouvertureModal', () => {
    ouvertureModal();
    expect(fenetre_modal.style.display).toBe('block');
  });

  test('fermetureModal', () => {
    fermetureModal();
    expect(fenetre_modal.style.display).toBe('none');
  });

  test('Appuyer hors de la modal la ferme', () => {
    ouvertureModal();

    const element_exterieur_modal = document.createElement('div');
    document.body.appendChild(element_exterieur_modal);

    element_exterieur_modal.click();
    expect(fenetre_modal.style.display).toBe('none');
  });

  test('Cliquer dans la modal ne la ferme pas', () => {
    ouvertureModal();

    const element_interieur_modal = document.createElement('div');
    contenu_modal.appendChild(element_interieur_modal);

    element_interieur_modal.click();
    expect(fenetre_modal.style.display).toBe('block');
  });
});