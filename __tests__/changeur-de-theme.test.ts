import { pasDePreference, basculeSurThemeSombre } from '../resources/ts/changeur-de-theme.ts';

describe('Changeur de thème', () => {
  it('Il ne doit pas détecter de préférence de thème', () => {
    window.matchMedia = jest.fn().mockReturnValue({ matches: true });

    const result = pasDePreference();
    expect(result).toBeTruthy();
  });

  it('Il doit basculer sur le thème sombre', () => {
    document.documentElement.setAttribute = jest.fn();

    basculeSurThemeSombre();
    expect(document.documentElement.setAttribute).toHaveBeenCalledWith('data-theme', 'dark');
  });
});
