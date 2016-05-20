<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$init = function($extKey)
{
	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Dennis.' . $extKey,
		'web',	 // Make module a submodule of 'tools'
		'seedermod',	// Submodule key
		'',						// Position
		array(
			'Seeder' => 'index, new, create',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $extKey . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_seedermod.xlf',
		)
	);
};

if (TYPO3_MODE === 'BE') {

	$init($_EXTKEY);
	unset($init);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Seeder');
