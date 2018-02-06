<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
    \Dennis\Seeder\Command\SeederCommandController::class;

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['seeder']['provider']['image'] =
    \Dennis\Seeder\Provider\Provider\Image::class;
