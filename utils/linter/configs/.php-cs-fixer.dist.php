<?php

use App\Fixer\ClassNotation\CustomControllerOrderFixer;
use App\Fixer\ClassNotation\CustomOrderedClassElementsFixer;
use App\Fixer\ClassNotation\CustomPhpUnitOrderFixer;
use App\Support\PhpCsFixer;
use PhpCsFixer\Config;

return (new Config)
    ->setFinder(PhpCsFixer::getFinder())
    ->setUsingCache(false)
    ->registerCustomFixers([
        new CustomControllerOrderFixer,
        new CustomOrderedClassElementsFixer,
        new CustomPhpUnitOrderFixer,
    ])
    ->setRules([
        'Tighten/custom_controller_order' => true,
        'Tighten/custom_ordered_class_elements' => true,
        'Tighten/custom_phpunit_order' => true,
        'align_multiline_comment' => [
            'comment_type' => 'phpdocs_only',
        ],
        'array_indentation' => true,
        'array_push' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
        'assign_null_coalescing_to_coalesce_equal' => true,
        'attribute_empty_parentheses' => [
            'use_parentheses' => false,
        ],
        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'continue',
                'declare',
                'do',
                'exit',
                'for',
                'foreach',
                'goto',
                'if',
                'include',
                'include_once',
                'phpdoc',
                'require',
                'require_once',
                'return',
                'switch',
                'throw',
                'try',
                'while',
                'yield',
                'yield_from',
            ],
        ],
        'blank_lines_before_namespace' => [
            'min_line_breaks' => 1,
            'max_line_breaks' => 1,
        ],
        'cast_spaces' => [
            'space' => 'single',
        ],
        'class_attributes_separation' => [
            'elements' => [
                'const' => 'none',
                'method' => 'one',
                'property' => 'none',
                'trait_import' => 'none',
                'case' => 'none',
            ],
        ],
        'class_keyword' => true,
        'class_reference_name_casing' => true,
        'clean_namespace' => true,
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'combine_nested_dirname' => true,
        'compact_nullable_type_declaration' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],
        'constant_case' => [
            'case' => 'lower',
        ],
        'control_structure_braces' => true,
        'control_structure_continuation_position' => [
            'position' => 'same_line',
        ],
        'declare_equal_normalize' => [
            'space' => 'single',
        ],
        'declare_parentheses' => true,
        'dir_constant' => true,
        'elseif' => true,
        'empty_loop_body' => [
            'style' => 'semicolon',
        ],
        'empty_loop_condition' => [
            'style' => 'while',
        ],
        'ereg_to_preg' => true,
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        'final_class' => true,
        'fopen_flag_order' => true,
        'full_opening_tag' => true,
        'fully_qualified_strict_types' => [
            'import_symbols' => true,
        ],
        'function_declaration' => [
            'closure_fn_spacing' => 'none',
        ],
        'function_to_constant' => [
            'functions' => [
                'get_called_class',
                'get_class',
                'get_class_this',
                'php_sapi_name',
                'phpversion',
                'pi',
            ],
        ],
        'get_class_to_class_keyword' => true,
        'global_namespace_import' => [
            'import_constants' => true,
            'import_functions' => true,
            'import_classes' => true,
        ],
        'group_import' => [
            'group_types' => [
                'classy',
                'functions',
                'constants',
            ],
        ],
        'implode_call' => true,
        'include' => true,
        'is_null' => true,
        'lambda_not_used_import' => true,
        'list_syntax' => true,
        'logical_operators' => true,
        'long_to_shorthand_operator' => true,
        'lowercase_cast' => true,
        'lowercase_keywords' => true,
        'lowercase_static_reference' => true,
        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'method_chaining_indentation' => true,
        'modernize_strpos' => true,
        'modernize_types_casting' => true,
        'multiline_comment_opening_closing' => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        'native_function_casing' => true,
        'native_type_declaration_casing' => true,
        'new_with_parentheses' => [
            'anonymous_class' => false,
            'named_class' => false,
        ],
        'no_alternative_syntax' => [
            'fix_non_monolithic_code' => true,
        ],
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_closing_tag' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_leading_namespace_whitespace' => true,
        'no_mixed_echo_print' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_multiple_statements_per_line' => true,
        'no_php4_constructor' => true,
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_space_around_double_colon' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_around_offset' => [
            'positions' => [
                'inside',
                'outside',
            ],
        ],
        'no_superfluous_elseif' => true,
        'no_trailing_comma_in_singleline' => [
            'elements' => [
                'arguments',
                'array_destructuring',
                'array',
                'group_import',
            ],
        ],
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_unneeded_control_parentheses' => [
            'statements' => [
                'break',
                'clone',
                'continue',
                'echo_print',
                'negative_instanceof',
                'others',
                'return',
                'switch_case',
                'yield',
                'yield_from',
            ],
        ],
        'no_unneeded_final_method' => [
            'private_methods' => true,
        ],
        'no_unneeded_import_alias' => true,
        'no_unset_cast' => true,
        'no_unused_imports' => true,
        'no_useless_concat_operator' => true,
        'no_useless_else' => true,
        'no_useless_nullsafe_operator' => true,
        'no_useless_return' => true,
        'no_useless_sprintf' => true,
        'no_whitespace_before_comma_in_array' => [
            'after_heredoc' => false,
        ],
        'no_whitespace_in_blank_line' => true,
        'not_operator_with_successor_space' => true,
        'numeric_literal_separator' => [
            'strategy' => 'no_separator',
        ],
        'object_operator_without_whitespace' => true,
        'operator_linebreak' => [
            'position' => 'beginning',
        ],
        'phpdoc_indent' => true,
        'phpdoc_no_useless_inheritdoc' => true,
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'regular_callable_call' => true,
        'return_assignment' => true,
        'return_type_declaration' => [
            'space_before' => 'none',
        ],
        'self_accessor' => true,
        'set_type_to_cast' => true,
        'short_scalar_cast' => true,
        'simple_to_complex_string_variable' => true,
        'simplified_if_return' => true,
        'single_blank_line_at_eof' => true,
        'single_class_element_per_statement' => [
            'elements' => [
                'const',
                'property',
            ],
        ],
        'single_line_after_imports' => true,
        'single_line_comment_spacing' => true,
        'single_line_empty_body' => true,
        'single_quote' => [
            'strings_containing_single_quote_chars' => true,
        ],
        'single_trait_insert_per_statement' => true,
        'spaces_inside_parentheses' => [
            'space' => 'none',
        ],
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true,
        'ternary_operator_spaces' => true,
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline' => [
            'elements' => [
                'arguments',
                'array_destructuring',
                'arrays',
                'match',
                'parameters',
            ],
        ],
        'trim_array_spaces' => true,
        'type_declaration_spaces' => [
            'elements' => [
                'function',
                'property',
            ],
        ],
        'types_spaces' => [
            'space' => 'none',
        ],
        'unary_operator_spaces' => [
            'only_dec_inc' => false,
        ],
        'use_arrow_functions' => true,
        'void_return' => true,
        'whitespace_after_comma_in_array' => [
            'ensure_single_space' => true,
        ],

    ]);
