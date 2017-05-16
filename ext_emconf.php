<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "seeder"
 *
 * Auto generated by Extension Builder 2016-04-18
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Seeder',
    'description' => 'Seeder is a TYPO3 Extension that generates fake data for your TYPO3 Extension. Its intended for developers only!!! This Version is an experimental version!',
    'category' => 'backend',
    'author' => 'Dennis Römmich',
    'author_email' => 'dennis@roemmich.eu',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.2',
    'constraints' => array(
        'depends' => array(
            'typo3' => '7.6.0-8.7.99',
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
    'autoload' => array(
        'psr-4' => array(
            'Dennis\\Seeder\\' => 'Classes'
        ),
    ),
    'autoload-dev' => array(
        'psr-4' => array(
            'Dennis\\Seeder\\Tests\\' => 'Tests',
        ),
    ),
);
