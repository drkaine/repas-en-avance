<?php

declare(strict_types = 1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$config = new Config;

return $config->
	setRiskyAllowed(true)->
	setIndent("\t")->
	setUsingCache(true)->
	setRules([
		// Chaque ligne de DocComments multiligne doit avoir un astérisque [PSR-5] et doit être alignée avec la première.
		'align_multiline_comment' => true,
		// Chaque élément d'un tableau doit être indenté exactement une fois.
		'array_indentation' => true,
		// Convertit les utilisations simples de `array_push($x, $y);` en `$x[] = $y;`.
		'array_push' => true,
		// Les tableaux PHP doivent être déclarés en utilisant la syntaxe configurée.
		'array_syntax' => true,
		// Utilisez l'opérateur d'assignation de coalescence nulle `??=` lorsque cela est possible.
		'assign_null_coalescing_to_coalesce_equal' => true,
		// Convertit les opérateurs backtick en appels `shell_exec`.
		'backtick_to_shell_exec' => true,
		// Les opérateurs binaires doivent être entourés d'espaces selon la configuration.
		'binary_operator_spaces' => true,
		// Il doit y avoir une ligne vide après la déclaration de namespace.
		'blank_line_after_namespace' => true,
		// Assurez-vous qu'il n'y a pas de code sur la même ligne que la balise d'ouverture PHP et qu'elle est suivie d'une ligne vide.
		'blank_line_after_opening_tag' => true,
		// Un saut de ligne vide doit précéder toute instruction configurée.
		'blank_line_before_statement' => true,
		// Ajout de sauts de ligne entre les groupes d'instructions `use`.
		'blank_line_between_import_groups' => true,
		// Un seul espace ou aucun doit être entre la conversion et la variable.
		'cast_spaces' => true,
		// Les éléments de classe, de trait et d'interface doivent être séparés par une ou aucune ligne vide.
		'class_attributes_separation' => true,
		// Les espaces autour des mots-clés d'une définition de classe, de trait, d'énumération ou d'interface doivent être d'un seul espace.
		'class_definition' => true,
		// Lors de la référence à une classe interne, elle doit être écrite en respectant la casse correcte.
		'class_reference_name_casing' => true,
		// Le namespace ne doit pas contenir d'espaces, de commentaires ou de PHPDoc.
		'clean_namespace' => true,
		// L'utilisation de `isset($var) &&` plusieurs fois doit être faite en un seul appel.
		'combine_consecutive_issets' => true,
		// L'appel à `unset` sur plusieurs éléments doit être effectué en un seul appel.
		'combine_consecutive_unsets' => true,
		// Remplace les appels imbriqués multiples de `dirname` par un seul appel avec le deuxième paramètre `$level`. Requiert PHP >= 7.0.
		'combine_nested_dirname' => true,
		// Supprime les espaces supplémentaires dans une indication de type nullable.
		'compact_nullable_typehint' => true,
		// La concaténation doit être espacée selon la configuration.
		'concat_space' => ['spacing' => 'one'],
		// Les constantes PHP `true`, `false` et `null` DOIVENT être écrites avec la casse correcte.
		'constant_case' => true,
		// Le corps de chaque structure de contrôle DOIT être inclus dans des accolades.
		'control_structure_braces' => true,
		// Le mot-clé de continuation de la structure de contrôle doit être sur la ligne configurée.
		'control_structure_continuation_position' => true,
		// Les accolades doivent être placées comme configuré.
		'curly_braces_position' => true,
		// Le signe égal dans la déclaration de déclaration doit être entouré d'espaces ou non suivant la configuration.
		'declare_equal_normalize' => ['space' => 'single'],
		// Il ne doit pas y avoir d'espaces autour des parenthèses de la déclaration `declare`.
		'declare_parentheses' => true,
		// Force la déclaration de types stricts dans tous les fichiers. Requiert PHP >= 7.0.
		'declare_strict_types' => true,
		// Remplace l'expression `dirname(__FILE__)` par la constante équivalente `__DIR__`.
		'dir_constant' => true,
		// Les annotations Doctrine doivent utiliser l'opérateur configuré pour l'assignation dans les tableaux.
		'doctrine_annotation_array_assignment' => true,
		// Les annotations Doctrine sans arguments doivent utiliser la syntaxe configurée.
		'doctrine_annotation_braces' => true,
		// Les annotations Doctrine doivent être indentées avec quatre espaces.
		'doctrine_annotation_indentation' => true,
		// Corrige les espaces dans les annotations Doctrine.
		'doctrine_annotation_spaces' => true,
		// Remplace les courts tags d'écho <?= par la syntaxe longue <?php echo/<?php print, ou inversement.
		'echo_tag_syntax' => true,
		// Le mot-clé elseif doit être utilisé à la place de else if pour que tous les mots-clés de contrôle ressemblent à des mots simples.
		'elseif' => true,
		// Le corps de la boucle vide doit être dans le style configuré.
		'empty_loop_body' => true,
		// La condition de boucle vide doit être dans le style configuré.
		'empty_loop_condition' => true,
		// Le code PHP doit utiliser uniquement l'encodage UTF-8 sans BOM (supprimer le BOM).
		'encoding' => true,
		// Remplace les fonctions d'expression régulière ereg obsolètes par preg.
		'ereg_to_preg' => true,
		// Ajoute des accolades aux variables indirectes pour les rendre plus claires à comprendre. Requiert PHP >= 7.0.
		'explicit_indirect_variable' => true,
		// Convertit les variables implicites en variables explicites dans les chaînes de caractères à guillemets doubles ou en syntaxe heredoc.
		'explicit_string_variable' => true,
		// Le code PHP doit utiliser les balises <?php longues ou les balises d'écho court <?= et non pas d'autres variations de balises.
		'full_opening_tag' => true,
		// Transforme les paramètres FQCN importés et les types de retour dans les arguments de fonction en version courte.
		'fully_qualified_strict_types' => true,
		// Les espaces doivent être correctement placés dans la déclaration d'une fonction.
		'function_declaration' => true,
		// Assurez-vous qu'il y ait un seul espace entre l'argument d'une fonction et son type d'annotation.
		'function_typehint_space' => true,
		// Les annotations configurées doivent être omises de PHPDoc.
		'general_phpdoc_annotation_remove' => true,
		// Renomme les tags PHPDoc.
		'general_phpdoc_tag_rename' => true,
		// Importe ou qualifie complètement les classes/fonctions/constantes globales.
		'global_namespace_import' => true,
		// Le contenu des heredoc/nowdoc doit être correctement indenté. Requiert PHP >= 7.3.
		'heredoc_indentation' => true,
		// Convertit les heredoc en nowdoc si possible.
		'heredoc_to_nowdoc' => true,
		// La fonction implode doit être appelée avec 2 arguments dans l'ordre documenté.
		'implode_call' => true,
		// L'inclusion de fichiers et les chemins de fichier doivent être séparés par un seul espace. Le chemin du fichier ne doit pas être placé sous des crochets.
		'include' => true,
		// Les opérateurs d'incrémentation et de décrémentation avant ou après doivent être utilisés si possible.
		'increment_style' => ['style' => 'post'],
		// Le code doit utiliser le type d'indentation configuré.
		'indentation_type' => true,
		// Les littéraux d'entiers doivent être en bonne casse.
		'integer_literal_case' => true,
		// Lambda doit ne pas importer des variables qu'elle n'utilise pas.
		'lambda_not_used_import' => true,
		// Tous les fichiers PHP doivent utiliser la même fin de ligne.
		'line_ending' => true,
		// Assurez-vous qu'il n'y a pas de code sur la même ligne que la balise d'ouverture PHP.
		'linebreak_after_opening_tag' => true,
		// L'assignation de liste (array destructuring) doit être déclarée en utilisant la syntaxe configurée. Requiert PHP >= 7.1.
		'list_syntax' => true,
		// Utilisez les opérateurs logiques && et || au lieu de and et or.
		'logical_operators' => true,
		// La conversion de type doit être écrite en minuscules.
		'lowercase_cast' => true,
		// Les mots-clés PHP DOIVENT être en minuscules.
		'lowercase_keywords' => true,
		// Les références statiques de classe self, static et parent DOIVENT être en minuscules.
		'lowercase_static_reference' => true,
		// Les constantes magiques doivent être référencées en utilisant la casse correcte.
		'magic_constant_casing' => true,
		// Les définitions et appels de méthodes magiques doivent utiliser la casse correcte.
		'magic_method_casing' => true,
		// Dans les arguments de méthode et l'appel de méthode, il ne doit PAS y avoir d'espace avant chaque virgule et il DOIT y avoir un espace après chaque virgule. Les listes d'arguments PEUVENT être réparties sur plusieurs lignes, où chaque ligne suivante est indentée une fois. Dans ce cas, le premier élément de la liste DOIT être sur la ligne suivante, et il ne DOIT y avoir qu'un argument par ligne.
		'method_argument_space' => true,
		// Le chaînage de méthodes DOIT être correctement indenté. Le chaînage de méthodes avec différents niveaux d'indentation n'est pas pris en charge.
		'method_chaining_indentation' => true,
		// Remplace les appels strpos() par str_starts_with() ou str_contains() si possible.
		'modernize_strpos' => true,
		// Remplace les appels de fonction intval, floatval, doubleval, strval et boolval par l'opérateur de conversion de type approprié.
		'modernize_types_casting' => true,
		// Les blocs de documentation doivent commencer par deux astérisques, les commentaires multilignes doivent commencer par un seul astérisque, après la barre oblique ouvrante. Les deux doivent se terminer par un seul astérisque avant la barre oblique fermante.
		'multiline_comment_opening_closing' => true,
		// Interdit l'utilisation de l'espacement sur plusieurs lignes avant le point-virgule de fermeture ou déplacez le point-virgule sur la nouvelle ligne pour les appels chaînés.
		'multiline_whitespace_before_semicolons' => true,
		// Les fonctions définies par PHP doivent être appelées en utilisant la casse correcte.
		'native_function_casing' => true,
		// Les indications de type de fonction native doivent utiliser la casse correcte
		'native_function_type_declaration_casing' => true,
		// Toutes les déclarations de type de fonction native doivent être en minuscules.
		'new_with_braces' => ['anonymous_class' => false, 'named_class' => false],
		// Toutes les instances créées avec le mot clé new doivent être suivies (ou pas) de parenthèses.
		'no_alias_language_construct_call' => true,
		// Les constructions de langage maître doivent être utilisées plutôt que les alias.
		'no_alternative_syntax' => true,
		// Il ne doit pas y avoir de drapeau binaire avant les chaînes de caractères.
		'no_binary_string' => true,
		// Il ne doit pas y avoir de lignes vides après l'ouverture d'accolade de classe.
		'no_blank_lines_after_class_opening' => true,
		// Il ne doit pas y avoir de lignes vides entre la docblock et l'élément documenté.
		'no_blank_lines_after_phpdoc' => true,
		// Il ne doit pas y avoir de lignes vides avant une déclaration de namespace.
		'no_blank_lines_before_namespace' => false,
		// Il doit y avoir un commentaire lorsque la chute est intentionnelle dans un corps de cas non vide.
		'no_break_comment' => true,
		// La balise de fermeture ? > DOIT être omise des fichiers contenant uniquement du PHP.
		'no_closing_tag' => true,
		// Il ne doit pas y avoir de commentaires vides.
		'no_empty_comment' => true,
		// Il ne doit pas y avoir de blocs PHPDoc vides.
		'no_empty_phpdoc' => true,
		// Supprime les déclarations inutiles (point-virgule).
		'no_empty_statement' => true,
		// Supprime les lignes vides supplémentaires et/ou les lignes vides suivant la configuration.
		'no_extra_blank_lines' => true,
		// Supprime les slashes initiaux dans les clauses use.
		'no_leading_import_slash' => true,
		// La ligne de déclaration de namespace ne doit pas contenir d'espaces blancs initiaux.
		'no_leading_namespace_whitespace' => true,
		// Soit la construction de langage print soit echo doit être utilisée.
		'no_mixed_echo_print' => ['use' => 'print'],
		// L'opérateur => ne doit pas être entouré d'espaces blancs sur plusieurs lignes.
		'no_multiline_whitespace_around_double_arrow' => true,
		// Il ne doit pas y avoir plus d'une instruction par ligne.
		'no_multiple_statements_per_line' => true,
		// Les propriétés ne doivent pas être explicitement initialisées avec null sauf lorsqu'elles ont une déclaration de type (PHP 7.4).
		'no_null_property_initialization' => true,
		// Le casting court bool à l'aide de deux points d'exclamation ne doit pas être utilisé.
		'no_short_bool_cast' => true,
		// Les espaces unilinéaires avant le point-virgule de fermeture sont interdits.
		'no_singleline_whitespace_before_semicolons' => true,
		// Il ne doit y avoir aucun espace autour des doubles deux-points (également appelés opérateur de résolution de portée ou Paamayim Nekudotayim).
		'no_space_around_double_colon' => true,
		// Lors de l'appel d'une méthode ou d'une fonction, il NE DOIT PAS y avoir d'espace entre le nom de la méthode ou de la fonction et la parenthèse ouvrante.
		'no_spaces_after_function_name' => true,
		// Il NE DOIT PAS y avoir d'espaces autour des accolades d'offset.
		'no_spaces_around_offset' => true,
		// Il NE DOIT PAS y avoir d'espace après la parenthèse ouvrante. Il NE DOIT PAS y avoir d'espace avant la parenthèse fermante.
		'no_spaces_inside_parenthesis' => true,
		// Supprime les balises @param, @return et @var qui ne fournissent aucune information utile.
		'no_superfluous_phpdoc_tags' => true,
		// Supprime les espaces en fin de ligne des lignes non vides.
		'no_trailing_whitespace' => true,
		// Il NE DOIT y avoir aucun espace de fin après un commentaire ou une PHPDoc.
		'no_trailing_whitespace_in_comment' => true,
		// Supprime les parenthèses inutiles autour des instructions de contrôle.
		'no_unneeded_control_parentheses' => true,
		// Supprime les accolades inutiles qui ne font pas partie du corps d'une structure de contrôle.
		'no_unneeded_curly_braces' => true,
		// Les imports ne doivent pas être aliassés avec le même nom.
		'no_unneeded_import_alias' => true,
		// Les variables doivent être définies à null au lieu d'utiliser la conversion (unset).
		'no_unset_cast' => true,
		// Les déclarations use inutilisées doivent être supprimées.
		'no_unused_imports' => true,
		// Il ne doit pas y avoir d'opérations de concaténation inutiles.
		'no_useless_concat_operator' => true,
		// Il ne doit pas y avoir de cas else inutiles.
		'no_useless_else' => true,
		// Il ne doit pas y avoir d'opérateurs ?-> null-safe inutiles utilisés.
		'no_useless_nullsafe_operator' => true,
		// Il ne doit pas y avoir d'instruction return vide à la fin d'une fonction.
		'no_useless_return' => true,
		// Dans la déclaration de tableau, il NE DOIT PAS y avoir d'espace avant chaque virgule.
		'no_whitespace_before_comma_in_array' => ['after_heredoc' => true],
		// Supprime les espaces de fin de ligne des lignes vides.
		'no_whitespace_in_blank_line' => true,
		// L'index de tableau doit toujours être écrit en utilisant des crochets carrés.
		'normalize_index_brace' => true,
		// Ajoute ou supprime le ? avant les déclarations de type pour les paramètres ayant une valeur par défaut null.
		'nullable_type_declaration_for_default_null_value' => true,
		// Il ne doit pas y avoir d'espace avant ou après les opérateurs d'objet -> et ?->.
		'object_operator_without_whitespace' => true,
		// Les opérateurs - lorsqu'ils sont multi-lignes - doivent toujours être au début ou à la fin de la ligne.
		'operator_linebreak' => ['position' => 'end'],
		// Ordonne les éléments des classes/interfaces/traites/enums.
		'ordered_class_elements' => true,
		// Ordonne les déclarations use.
		'ordered_imports' => true,
		// Ordonne les interfaces dans une clause implements ou interface extends.
		'ordered_interfaces' => true,
		// Applique la casse camel (ou snake) pour les méthodes de test PHPUnit, en suivant la configuration.
		'php_unit_method_casing' => true,
		// Les méthodes PHPUnit telles que assertSame doivent être utilisées plutôt que assertEquals.
		'php_unit_strict' => true,
		// Ajoute une annotation @coversNothing par défaut aux classes de test PHPUnit qui n'ont aucune annotation @covers*.
		'php_unit_test_class_requires_covers' => true,
		// PHPDoc doit contenir @param pour tous les paramètres.
		'phpdoc_add_missing_param_annotation' => true,
		// Tous les éléments des balises phpdoc donnés doivent être alignés soit à gauche, soit (par défaut) alignés verticalement.
		'phpdoc_align' => true,
		// Les descriptions d'annotations de PHPDoc ne doivent pas être une phrase.
		'phpdoc_annotation_without_dot' => true,
		// Les blocs de documentation doivent avoir la même indentation que le sujet documenté.
		'phpdoc_indent' => true,
		// Corrige les tags en ligne de PHPDoc.
		'phpdoc_inline_tag_normalizer' => true,
		// Change les blocs de documentation de simple à multiple ligne, ou inversement. Fonctionne uniquement pour les constantes de classe, les propriétés et les méthodes.
		'phpdoc_line_span' => true,
		// Les annotations @access doivent être omises de PHPDoc.
		'phpdoc_no_access' => true,
		// Aucune balise PHPDoc d'alias ne doit être utilisée.
		'phpdoc_no_alias_tag' => true,
		// Les annotations @return void et @return null doivent être omises de PHPDoc.
		'phpdoc_no_empty_return' => true,
		// Les annotations @package et @subpackage doivent être omises de PHPDoc.
		'phpdoc_no_package' => true,
		// Les classes qui n'héritent pas ne doivent pas avoir de balises @inheritdoc.
		'phpdoc_no_useless_inheritdoc' => true,
		// Les annotations dans PHPDoc doivent être ordonnées dans une séquence définie.
		'phpdoc_order' => true,
		// Ordonne les balises phpdoc par valeur.
		'phpdoc_order_by_value' => true,
		// Le type des annotations @return des méthodes renvoyant une référence à elle-même doit être celui configuré.
		'phpdoc_return_self_reference' => true,
		// Les types scalaires doivent toujours être écrits de la même manière. int plutôt que integer, bool plutôt que boolean, float plutôt que real ou double.
		'phpdoc_scalar' => true,
		// Les annotations dans PHPDoc doivent être regroupées de manière à ce que les annotations du même type suivent immédiatement les unes des autres. Les annotations d'un type différent sont séparées par une seule ligne vide.
		'phpdoc_separation' => true,
		// Les PHPDoc sur une seule ligne @var doivent avoir un espacement correct.
		'phpdoc_single_line_var_spacing' => true,
		// Le résumé des PHPDoc doit se terminer par un point, un point d'exclamation ou un point d'interrogation.
		'phpdoc_summary' => true,
		// Les balises PHPDoc doivent être soit des annotations régulières, soit en ligne.
		'phpdoc_tag_type' => true,
		// Les blocs de documentation doivent être utilisés uniquement sur les éléments structuraux.
		'phpdoc_to_comment' => true,
		// Les PHPDoc doivent commencer et se terminer par un contenu, en excluant la toute première et la toute dernière ligne des blocs de documentation.
		'phpdoc_trim' => true,
		// Supprime les lignes vides supplémentaires après le résumé et après la description dans les PHPDoc.
		'phpdoc_trim_consecutive_blank_line_separation' => true,
		// Le cas correct doit être utilisé pour les types PHP standard dans les PHPDoc.
		'phpdoc_types' => true,
		// Trie les types PHPDoc.
		'phpdoc_types_order' => true,
		// Les annotations @var et @type doivent avoir le type et le nom dans le bon ordre.
		'phpdoc_var_annotation_correct_order' => true,
		// Convertit pow en l'opérateur **.
		'pow_to_exponentiation' => true,
		// Ajuste l'espacement autour des deux-points dans les déclarations de type de retour et les types d'énumération supportés.
		'return_type_declaration' => true,
		// Les instructions doivent être terminées par un point-virgule.
		'semicolon_after_instruction' => true,
		// Il faut utiliser le cast, pas settype.
		'set_type_to_cast' => true,
		// Les casts (boolean) et (integer) doivent être écrits comme (bool) et (int), (double) et (real) comme (float), (binary) comme (string).
		'short_scalar_cast' => true,
		// Convertit les variables explicites dans les chaînes à double guillemets et dans la syntaxe heredoc du format simple au format complexe (${ à {$).
		'simple_to_complex_string_variable' => true,
		// Simplifie les structures de contrôle if qui retournent le résultat booléen de leur condition.
		'simplified_if_return' => true,
		// Une instruction de retour souhaitant renvoyer void ne doit pas renvoyer null.
		'simplified_null_return' => true,
		// Un fichier PHP sans balise de fin doit toujours se terminer par une seule ligne vide.
		'single_blank_line_at_eof' => true,
		// Il doit y avoir exactement une ligne vide avant une déclaration d'espace de noms.
		'single_blank_line_before_namespace' => true,
		// Il ne doit y avoir qu'une seule propriété ou constante déclarée par instruction.
		'single_class_element_per_statement' => true,
		// Il doit y avoir un mot-clé use par déclaration.
		'single_import_per_statement' => true,
		// Chaque utilisation d'espace de noms doit être sur sa propre ligne et il doit y avoir une ligne vide après le bloc d'instructions use.
		'single_line_after_imports' => true,
		// Les commentaires en ligne doivent avoir un espacement correct.
		'single_line_comment_spacing' => true,
		// Les commentaires en ligne et les commentaires multi-lignes avec une seule ligne de contenu doivent utiliser la syntaxe //.
		'single_line_comment_style' => true,
		// Les exceptions doivent être lancées en une seule ligne.
		'single_line_throw' => true,
		// Convertir les guillemets doubles en guillemets simples pour les chaînes simples.
		'single_quote' => ['strings_containing_single_quote_chars' => true],
		// Assure un seul espace après les constructions de langage.
		'single_space_around_construct' => true,
		// Chaque utilisation de trait use doit être faite en tant que déclaration unique.
		'single_trait_insert_per_statement' => true,
		// Correction des espaces après un point-virgule.
		'space_after_semicolon' => ['remove_in_empty_for_expressions' => false],
		// Les opérateurs d'incrémentation et de décrémentation doivent être utilisés si possible.
		'standardize_increment' => true,
		// Remplacer tous les <> par !=.
		'standardize_not_equals' => true,
		// Chaque instruction doit être indentée.
		'statement_indentation' => true,
		// Les comparaisons doivent être strictes.
		'strict_comparison' => true,
		// Un cas doit être suivi d'un deux-points et non d'un point-virgule.
		'switch_case_semicolon_to_colon' => true,
		// Supprime les espaces supplémentaires entre les deux-points et la valeur du cas.
		'switch_case_space' => true,
		// Espace standardisé autour de l'opérateur ternaire.
		'ternary_operator_spaces' => true,
		// Utiliser l'opérateur de coalescence nulle ?? lorsque possible. Nécessite PHP >= 7.0.
		'ternary_to_null_coalescing' => true,
		// Les tableaux multi-lignes, la liste des arguments, la liste des paramètres et les expressions match doivent avoir une virgule finale.
		'trailing_comma_in_multiline' => ['after_heredoc' => true],
		// Les tableaux doivent être formatés comme les arguments de fonction/méthode, sans espace de ligne unique en tête ou en queue.
		'trim_array_spaces' => true,
		// Un seul espace ou aucun doit être utilisé autour des opérateurs de type d'union et d'intersection.
		'types_spaces' => ['space' => 'single'],
		// La visibilité DOIT être déclarée pour toutes les propriétés et les méthodes ; abstract et final DOIVENT être déclarés avant la visibilité ; static DOIT être déclaré après la visibilité.
		'visibility_required' => ['elements' => ['const', 'method', 'property']],
		// Ajoute un type de retour 'void' aux fonctions avec des déclarations de retour manquantes ou vides, mais la priorité est donnée aux annotations '@return'. Requiert PHP >= 7.1.
		'void_return' => true,
		// Dans la déclaration d'un tableau, il DOIT y avoir un espace après chaque virgule.
		'whitespace_after_comma_in_array' => ['ensure_single_space' => true],
		// Écrire les conditions en style Yoda (true), en style non-Yoda (['equal' => false, 'identical' => false, 'less_and_greater' => false]) ou ignorer ces conditions (null) en fonction de la configuration.
		'yoda_style' => ['always_move_variable' => true, 'less_and_greater' => true],
	])->
	setFinder(
		Finder::create()->
		// ->exclude('folder-to-exclude') // si vous voulez exclure certains dossiers, vous pouvez le faire comme ceci !
			in([
				__DIR__ . '/app',
				__DIR__ . '/config',
				__DIR__ . '/tests',
                __DIR__ . '/database',
				__DIR__ . '/routes',
			])->
			name('*.php')->
			notName('*.blade.php')->
			ignoreDotFiles(true)->
			ignoreVCS(true)
	);
