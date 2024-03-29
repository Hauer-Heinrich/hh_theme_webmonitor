<?php
defined('TYPO3_MODE') || die();

call_user_func(function() {
    // Disable language copy for auto translated content
    $TCA['tt_content']['columns']['header']['l10n_mode'] = '';
    $TCA['tt_content']['columns']['bodytext']['l10n_mode'] = '';
});

// Configure new fields:
$fields = [
    'header_style' => [
        'label' => 'LLL:EXT:hh_theme_webmonitor/Resources/Private/Language/locallang_pageconfig.xlf:tceform.ttContent.headerStyle',
        'exclude' => 1,
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['default', 0],
            ],
        ],
    ],
];

// Add new fields to table:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

// Add fields to specific pallete
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'headers',
    'header_style',
    'after:header_layout'
);

// Add fields to TCAtypes instead of adding it to a specific palette like above:
// for example add a custom_palette:
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
//     'tt_content', // Table name
//     '--palette--;custom_palette;header_style', // Field list to add
//     '', // List of specific types to add the field list to. (If empty, all type entries are affected)
//     'after:header_layout' // Insert fields before (default) or after one, or replace a field
// );

// Add the new custom_palette:
// $GLOBALS['TCA']['pages']['palettes']['custom_palette'] = [
//     'showitem' => 'header_style'
// ];
