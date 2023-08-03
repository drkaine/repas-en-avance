module.exports = {
    parser: '@typescript-eslint/parser',
    plugins: ['@typescript-eslint'],
    extends: [
      'eslint:recommended', 
      'plugin:@typescript-eslint/recommended'
    ],
    rules: {
      // Exemple de règle : Utiliser 4 espaces pour l'indentation
      'indent': ['error', 4],

      // Exemple de règle : Utiliser des guillemets simples pour les chaînes de caractères
      'quotes': ['error', 'single'],

      // Exemple de règle : Interdire les déclarations de variables non utilisées
      'no-unused-vars': 'error', 

      // Exemple de règle : Autoriser l'utilisation de console.log dans le code (pas recommandé en production)
      'no-console': 'off',

      // Exemple de règle : Interdire les déclarations de fonction anonymes (préférer les fonctions nommées)
      'func-names': 'error',

      // Exemple de règle : Forcer l'utilisation de point-virgule à la fin des instructions
      'semi': ['error', 'always'],

      // Exemple de règle : Autoriser les fonctions vides (peut être désactivé en production)
      'no-empty-function': 'off',

      // Exemple de règle : Forcer la déclaration des variables (pas autoriser de variables globales non déclarées)
      'no-undef': 'error',
    
      // Virgule en dernier : mettre une virgule après chaque élément dans un objet ou un tableau sur plusieurs lignes
      'comma-dangle': ['error', 'always-multiline'],
      
      // Espacement des fonctions : mettre un espace avant et après les parenthèses des fonctions
      'space-before-function-paren': ['error', 'always'],
      
      // Pas d'espaces multiples : éviter d'avoir des espaces multiples dans le code
      'no-multi-spaces': 'error',
      
      // Points avant parenthèses : les points doivent être à la fin de la ligne
      'dot-location': ['error', 'property'],
      
      // Ne pas utiliser de variables non initialisées
      'init-declarations': 'error',
      
      // Utiliser des accolades pour les blocs de code sur plusieurs lignes
      'curly': ['error', 'multi-line'],
      
      // Espacement des opérateurs : mettre un espace avant et après les opérateurs
      'space-infix-ops': 'error',
      
      // Interdire les espaces avant les deux-points dans les propriétés d'objets
      'key-spacing': 'error',
      
      // Interdire les déclarations de fonction dans une boucle
      'no-loop-func': 'error',
      
      // Interdire les déclarations de variables dans la portée globale
      'no-implicit-globals': 'error',
      
      // Limiter la longueur des lignes de code à 100 caractères
      'max-len': ['error', { 'code': 100 }],
      
      // Utiliser des parenthèses autour des arguments de retour pour les fonctions fléchées
      'arrow-parens': ['error', 'always'],
      
      // Espacement des fonctions fléchées : mettre un espace avant et après le signe de la flèche
      'arrow-spacing': 'error',
      
      // Utiliser const pour les variables qui ne sont pas réassignées
      'prefer-const': 'error'
    },
  };
  