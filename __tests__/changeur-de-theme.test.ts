import {
  themeDePreference, 
  basculeSurTheme,
  recupererLeTheme, 
  afficherIcone, 
  dissimulerIcone, 
  afficherIconeSelonTheme,
  mettreEnPlaceLeTheme,
  changeurDeThemeAuClick,
} from '../resources/ts/changeur-de-theme.ts';

describe('Changeur de thème', () => {
  let html: HTMLElement; 

  beforeEach(() => {
    html = document.createElement('html');

    document.documentElement.setAttribute('data-theme', 'dark');

    document.body.appendChild(html);
  });

  afterEach(() => {
    html.remove();
  });

  it('Il ne doit pas détecter de préférence de thème', () => {
    window.matchMedia = jest.fn().mockImplementation(query => {
      return { matches: query === '(prefers-color-scheme: no-preference)' };
    });
    expect(themeDePreference('no-preference')).toBe(true);
  });

  it('Il doit détecter une préférence de thème sombre', () => {
    window.matchMedia = jest.fn().mockImplementation(query => {
      return { matches: query === '(prefers-color-scheme: dark)' };
    });
    expect(themeDePreference('dark')).toBe(true);
  });

  it('Il doit détecter une préférence de thème clair', () => {
    window.matchMedia = jest.fn().mockImplementation(query => {
      return { matches: query === '(prefers-color-scheme: light)' };
    });
  expect(themeDePreference('light')).toBe(true);
  });

  it('Il doit détecter une erreur', () => {
    window.matchMedia = jest.fn().mockImplementation(query => {
      return { matches: query === '(prefers-color-scheme: dark)' };
    });
    expect(themeDePreference('light')).toBe(false);
  });

  it('Il doit basculer sur le thème sombre', () => { 
    document.documentElement.setAttribute('data-theme', 'light');

    basculeSurTheme('dark'); 
    
    expect(document.documentElement.getAttribute('data-theme')).toBe('dark');
  });

  it('Il doit basculer sur le thème clair', () => {
    basculeSurTheme('light');

    expect(document.documentElement.getAttribute('data-theme')).toBe('light');
  });

  it('Renvoi true si le theme est sur sombre', () => {
    expect(recupererLeTheme('dark')).toBe(true);
  });

  it('Renvoi false si le theme n\'est pas sur sombre', () => {
    document.documentElement.setAttribute('data-theme', 'light');
    
    expect(recupererLeTheme('dark')).toBe(false);
  });

  it('Met le data-theme sur sombre si il n\'y a pas de thème de préférence', () => {
    window.matchMedia = jest.fn().mockImplementation(query => {
      return { matches: query === '(prefers-color-scheme: no-preference)' };
    });

    mettreEnPlaceLeTheme();
    
    expect(document.documentElement.getAttribute('data-theme')).toBe('dark');
  });

  it('Met le data-theme sur sombre si il le thème de préférence est sombre', () => {
    window.matchMedia = jest.fn().mockImplementation(query => {
      return { matches: query === '(prefers-color-scheme: dark)' };
    });

    mettreEnPlaceLeTheme();
    
    expect(document.documentElement.getAttribute('data-theme')).toBe('dark');
  });

  it('Met le data-theme sur sombre si il le thème de préférence est clair', () => {
    window.matchMedia = jest.fn().mockImplementation(query => {
      return { matches: query === '(prefers-color-scheme: light)' };
    });

    mettreEnPlaceLeTheme();
    
    expect(document.documentElement.getAttribute('data-theme')).toBe('light');
  });
});

describe('Gestion des icones', () => {
  let iconeSoleil: HTMLElement;
  let iconeLune: HTMLElement;
  let html: HTMLElement; 

  beforeEach(() => {
    iconeSoleil = document.createElement('i');
    iconeLune = document.createElement('i');
    html = document.createElement('html');

    iconeSoleil.id = 'iconeSoleil';
    iconeLune.id = 'iconeLune';

    document.body.appendChild(iconeSoleil);
    document.body.appendChild(iconeLune);
    document.body.appendChild(html);
  });

  afterEach(() => {
    iconeSoleil.remove();
    iconeLune.remove();

    html.remove();
  });

  it('L\'icone soleil doit être affichée', () => {
    afficherIcone('iconeSoleil');

    expect(iconeSoleil.style.display).toBe('inline');
  });

  it('L\'icone soleil doit être cachée', () => {
    dissimulerIcone('iconeSoleil');

    expect(iconeSoleil.style.display).toBe('none');
  });

  it('L\'icone lune doit être affichée', () => {
    afficherIcone('iconeLune');

    expect(iconeLune.style.display).toBe('inline');
  });

  it('L\'icone lune doit être cachée', () => {
    dissimulerIcone('iconeLune');

    expect(iconeLune.style.display).toBe('none');
  });

  it('L\'icone lune doit être cachée et l\'icone soleil doit être affichée avec un theme sombre', () => {
    document.documentElement.setAttribute('data-theme', 'dark');
    
    afficherIconeSelonTheme();

    expect(iconeSoleil.style.display).toBe('inline');
    expect(iconeLune.style.display).toBe('none');
  });

  it('L\'icone soleil doit être cachée et l\'icone lune doit être affichée avec un theme clair', () => {
    document.documentElement.setAttribute('data-theme', 'light');
    
    afficherIconeSelonTheme();
    
    expect(iconeLune.style.display).toBe('inline');
    expect(iconeSoleil.style.display).toBe('none');
  });
});

describe('Ecoute du click du bouton', () => {
  let changeurDeTheme: HTMLElement;
  let html: HTMLElement; 
  let iconeSoleil: HTMLElement;
  let iconeLune: HTMLElement;

  beforeEach(() => {
    changeurDeTheme = document.createElement('button');
    html = document.createElement('html');
    iconeSoleil = document.createElement('i');
    iconeLune = document.createElement('i');

    changeurDeTheme.id = 'changeur-de-theme';
    iconeSoleil.id = 'iconeSoleil';
    iconeLune.id = 'iconeLune';

    document.body.appendChild(iconeSoleil);
    document.body.appendChild(iconeLune);

    document.body.appendChild(changeurDeTheme);
    document.body.appendChild(html);
  });

  afterEach(() => {
    changeurDeTheme.remove();
    iconeSoleil.remove();
    iconeLune.remove();

    html.remove();
  });

  it('Passe le thème en clair après avoir cliqué sur le bouton en étant sur le thème sombre', () => {
    document.documentElement.setAttribute('data-theme', 'dark');

    changeurDeThemeAuClick();

    changeurDeTheme.click();

    expect(document.documentElement.getAttribute('data-theme')).toBe('light');
    expect(iconeLune.style.display).toBe('inline');
    expect(iconeSoleil.style.display).toBe('none');
  });

  it('Passe le thème en sombre après avoir cliqué sur le bouton en étant sur le thème clair', () => {
    document.documentElement.setAttribute('data-theme', 'light');

    changeurDeThemeAuClick();

    changeurDeTheme.click();

    expect(document.documentElement.getAttribute('data-theme')).toBe('dark');
    expect(iconeSoleil.style.display).toBe('inline');
    expect(iconeLune.style.display).toBe('none');
  });
});
