<?php
namespace TildBJ\Seeder\Tests\Functional\Seeder;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Dennis Römmich <dennis@roemmich.eu>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TildBJ\Seeder\Collection\SeedCollection;
use TildBJ\Seeder\Factory\SeederFactory;
use TildBJ\Seeder\Faker;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This Test checks if seeder is able to generate images
 * with the given tca informations
 *
 * @author Dennis Römmich <dennis@roemmich.eu>
 */
class ImageTest extends UnitTestCase
{
    /**
     * factory
     *
     * @var SeederFactory $factory
     */
    protected $factory = null;

    protected $faker;

    public function setUp()
    {
        $GLOBALS['TCA']['pages']['columns']['title'] = unserialize('a:2:{s:5:"label";s:36:"LLL:EXT:lang/locallang_tca.xlf:title";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"50";s:3:"max";s:3:"255";s:4:"eval";s:13:"trim,required";}}');
        $GLOBALS['TCA']['pages']['columns']['media'] = unserialize('a:3:{s:7:"exclude";i:1;s:5:"label";s:73:"LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.media";s:6:"config";a:9:{s:4:"type";s:6:"inline";s:13:"foreign_table";s:18:"sys_file_reference";s:13:"foreign_field";s:11:"uid_foreign";s:14:"foreign_sortby";s:15:"sorting_foreign";s:19:"foreign_table_field";s:10:"tablenames";s:20:"foreign_match_fields";a:1:{s:9:"fieldname";s:5:"media";}s:13:"foreign_label";s:9:"uid_local";s:16:"foreign_selector";s:9:"uid_local";s:33:"foreign_selector_fieldTcaOverride";a:1:{s:6:"config";a:1:{s:10:"appearance";a:2:{s:18:"elementBrowserType";s:4:"file";s:21:"elementBrowserAllowed";s:0:"";}}}}}');
        $GLOBALS['TCA']['sys_file_reference']['columns'] = unserialize('a:18:{s:11:"t3ver_label";a:3:{s:7:"exclude";i:0;s:5:"label";s:51:"LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel";s:6:"config";a:3:{s:4:"type";s:5:"input";s:4:"size";s:2:"30";s:3:"max";s:2:"30";}}s:16:"sys_language_uid";a:3:{s:7:"exclude";i:0;s:5:"label";s:47:"LLL:EXT:lang/locallang_general.xlf:LGL.language";s:6:"config";a:7:{s:4:"type";s:6:"select";s:10:"renderType";s:12:"selectSingle";s:13:"foreign_table";s:12:"sys_language";s:19:"foreign_table_where";s:27:"ORDER BY sys_language.title";s:5:"items";a:2:{i:0;a:2:{i:0;s:51:"LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages";i:1;i:-1;}i:1;a:2:{i:0;s:52:"LLL:EXT:lang/locallang_general.xlf:LGL.default_value";i:1;i:0;}}s:7:"default";i:0;s:13:"showIconTable";b:1;}}s:11:"l10n_parent";a:4:{s:11:"displayCond";s:26:"FIELD:sys_language_uid:>:0";s:7:"exclude";i:0;s:5:"label";s:50:"LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent";s:6:"config";a:6:{s:4:"type";s:6:"select";s:10:"renderType";s:12:"selectSingle";s:5:"items";a:1:{i:0;a:2:{i:0;s:0:"";i:1;i:0;}}s:13:"foreign_table";s:18:"sys_file_reference";s:19:"foreign_table_where";s:104:"AND sys_file_reference.uid=###REC_FIELD_l10n_parent### AND sys_file_reference.sys_language_uid IN (-1,0)";s:7:"default";i:0;}}s:15:"l10n_diffsource";a:2:{s:7:"exclude";i:0;s:6:"config";a:2:{s:4:"type";s:11:"passthrough";s:7:"default";s:0:"";}}s:6:"hidden";a:3:{s:7:"exclude";i:0;s:5:"label";s:45:"LLL:EXT:lang/locallang_general.xlf:LGL.hidden";s:6:"config";a:2:{s:4:"type";s:5:"check";s:7:"default";s:1:"0";}}s:9:"uid_local";a:3:{s:7:"exclude";i:0;s:5:"label";s:59:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.uid_local";s:6:"config";a:7:{s:4:"type";s:5:"group";s:13:"internal_type";s:2:"db";s:4:"size";i:1;s:4:"eval";s:3:"int";s:8:"maxitems";i:1;s:8:"minitems";i:0;s:7:"allowed";s:8:"sys_file";}}s:11:"uid_foreign";a:3:{s:7:"exclude";i:0;s:5:"label";s:61:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.uid_foreign";s:6:"config";a:3:{s:4:"type";s:5:"input";s:4:"size";s:2:"10";s:4:"eval";s:3:"int";}}s:10:"tablenames";a:3:{s:7:"exclude";i:0;s:5:"label";s:60:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.tablenames";s:6:"config";a:3:{s:4:"type";s:5:"input";s:4:"size";s:2:"30";s:4:"eval";s:4:"trim";}}s:9:"fieldname";a:3:{s:7:"exclude";i:0;s:5:"label";s:59:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.fieldname";s:6:"config";a:2:{s:4:"type";s:5:"input";s:4:"size";s:2:"30";}}s:15:"sorting_foreign";a:3:{s:7:"exclude";i:0;s:5:"label";s:65:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.sorting_foreign";s:6:"config";a:5:{s:4:"type";s:5:"input";s:4:"size";s:1:"4";s:3:"max";s:1:"4";s:4:"eval";s:3:"int";s:7:"default";i:0;}}s:11:"table_local";a:3:{s:7:"exclude";i:0;s:5:"label";s:61:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.table_local";s:6:"config";a:3:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:7:"default";s:8:"sys_file";}}s:5:"title";a:4:{s:9:"l10n_mode";s:15:"prefixLangTitle";s:7:"exclude";i:1;s:5:"label";s:55:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.title";s:6:"config";a:7:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:3:"max";i:255;s:4:"eval";s:4:"null";s:11:"placeholder";s:30:"__row|uid_local|metadata|title";s:4:"mode";s:24:"useOrOverridePlaceholder";s:7:"default";N;}}s:4:"link";a:3:{s:7:"exclude";i:1;s:5:"label";s:54:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.link";s:6:"config";a:5:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:3:"max";i:1024;s:7:"wizards";a:1:{s:4:"link";a:5:{s:4:"type";s:5:"popup";s:5:"title";s:54:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.link";s:4:"icon";s:19:"actions-wizard-link";s:6:"module";a:1:{s:4:"name";s:11:"wizard_link";}s:12:"JSopenParams";s:52:"width=800,height=600,status=0,menubar=0,scrollbars=1";}}s:7:"softref";s:8:"typolink";}}s:11:"description";a:4:{s:9:"l10n_mode";s:15:"prefixLangTitle";s:7:"exclude";i:1;s:5:"label";s:61:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.description";s:6:"config";a:7:{s:4:"type";s:4:"text";s:4:"cols";s:2:"20";s:4:"rows";s:1:"5";s:4:"eval";s:4:"null";s:11:"placeholder";s:36:"__row|uid_local|metadata|description";s:4:"mode";s:24:"useOrOverridePlaceholder";s:7:"default";N;}}s:11:"alternative";a:4:{s:9:"l10n_mode";s:15:"prefixLangTitle";s:7:"exclude";i:1;s:5:"label";s:61:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.alternative";s:6:"config";a:6:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:4:"eval";s:4:"null";s:11:"placeholder";s:36:"__row|uid_local|metadata|alternative";s:4:"mode";s:24:"useOrOverridePlaceholder";s:7:"default";N;}}s:4:"crop";a:3:{s:7:"exclude";i:1;s:5:"label";s:54:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.crop";s:6:"config";a:1:{s:4:"type";s:17:"imageManipulation";}}s:8:"autoplay";a:3:{s:7:"exclude";i:1;s:5:"label";s:58:"LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.autoplay";s:6:"config";a:2:{s:4:"type";s:5:"check";s:7:"default";i:0;}}s:13:"showinpreview";a:3:{s:7:"exclude";b:1;s:5:"label";s:97:"LLL:EXT:news/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_media.showinpreview";s:6:"config";a:2:{s:4:"type";s:5:"check";s:7:"default";i:0;}}}');

        $faker = $this->getMock(Faker::class);

        $this->factory = GeneralUtility::makeInstance(SeederFactory::class, $faker);
    }

    /**
     * @test
     */
    public function eachPageShouldHaveOneImage()
    {
        /** @var Pages $pagesSeed */
        $pagesSeed = GeneralUtility::makeInstance(Pages::class);
        $pagesSeed->run();
        $seedCollection = GeneralUtility::makeInstance(SeedCollection::class);

        $pages = [];
        foreach ($seedCollection->toArray()['pages'] as $key => $user) {
            $pages[$key] = $user['media'];
        }
        $this->assertSame([
            0 => 'NEW3',
            1 => 'NEW4',
        ], array_values($pages));
    }

    public function tearDown()
    {
        $seedCollection = GeneralUtility::makeInstance(SeedCollection::class);
        $seedCollection->clear();
    }
}
