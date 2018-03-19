<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
    \TildBJ\Seeder\Command\SeederCommandController::class;

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['seeder']['provider']['image'] =
    \TildBJ\Seeder\Provider\Provider\Image::class;
