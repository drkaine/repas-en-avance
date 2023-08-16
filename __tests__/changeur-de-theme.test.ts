import { themeDePreference, basculeSurTheme } from '../resources/ts/changeur-de-theme.ts';

describe('Changeur de thème', () => {
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
    document.documentElement.setAttribute = jest.fn();

    basculeSurTheme('dark');
    expect(document.documentElement.setAttribute).toHaveBeenCalledWith('data-theme', 'dark');
  });

  it('Il doit basculer sur le thème clair', () => {
    document.documentElement.setAttribute = jest.fn();

    basculeSurTheme('light');
    expect(document.documentElement.setAttribute).toHaveBeenCalledWith('data-theme', 'light');
  });
});
