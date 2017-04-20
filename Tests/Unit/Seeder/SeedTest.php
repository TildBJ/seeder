<?php
namespace Dennis\Seeder\Tests\Seeder;

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
use Dennis\Seeder\Collection\SeedCollection;
use Dennis\Seeder\Factory\SeederFactory;
use Dennis\Seeder\Faker;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Test case
 *
 * @author Dennis Römmich <dennis@roemmich.eu>
 */
class SeedTest extends UnitTestCase
{
    /**
     * @var array
     */
    protected $expected = [
        'fe_users' => [
            'NEW1' => [
                'username' => 'testData',
                'password' => 'testData',
                'usergroup' => 'NEW3,NEW4',
                'lockToDomain' => 'testData',
                'name' => 'testData',
                'first_name' => 'testData',
                'middle_name' => 'testData',
                'last_name' => 'testData',
                'address' => 'testData',
                'telephone' => 'testData',
                'fax' => 'testData',
                'email' => 'mail@example.org',
                'title' => 'testData',
                'zip' => 'testData',
                'city' => 'testData',
                'country' => 'testData',
                'www' => 'testData',
                'company' => 'testData',
                'image' => 'testData',
                'disable' => 'testData',
                'starttime' => 'testData',
                'endtime' => 'testData',
                'TSconfig' => 'testData',
                'lastlogin' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
                'felogin_forgotHash' => 'testData',
            ],
            'NEW2' => [
                'username' => 'testData',
                'password' => 'testData',
                'usergroup' => 'NEW5,NEW6',
                'lockToDomain' => 'testData',
                'name' => 'testData',
                'first_name' => 'testData',
                'middle_name' => 'testData',
                'last_name' => 'testData',
                'address' => 'testData',
                'telephone' => 'testData',
                'fax' => 'testData',
                'email' => 'mail@example.org',
                'title' => 'testData',
                'zip' => 'testData',
                'city' => 'testData',
                'country' => 'testData',
                'www' => 'testData',
                'company' => 'testData',
                'image' => 'testData',
                'disable' => 'testData',
                'starttime' => 'testData',
                'endtime' => 'testData',
                'TSconfig' => 'testData',
                'lastlogin' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
                'felogin_forgotHash' => 'testData',
            ],
        ],
        'fe_groups' => [
            'NEW3' => [
                'hidden' => 'testData',
                'title' => 'testData',
                'subgroup' => 'NEW7',
                'lockToDomain' => 'testData',
                'description' => 'testData',
                'TSconfig' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
            ],
            'NEW4' => [
                'hidden' => 'testData',
                'title' => 'testData',
                'subgroup' => 'NEW8',
                'lockToDomain' => 'testData',
                'description' => 'testData',
                'TSconfig' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
            ],
            'NEW5' => [
                'hidden' => 'testData',
                'title' => 'testData',
                'subgroup' => 'NEW9',
                'lockToDomain' => 'testData',
                'description' => 'testData',
                'TSconfig' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
            ],
            'NEW6' => [
                'hidden' => 'testData',
                'title' => 'testData',
                'subgroup' => 'NEW10',
                'lockToDomain' => 'testData',
                'description' => 'testData',
                'TSconfig' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
            ],
            'NEW7' => [
                'hidden' => 'testData',
                'title' => 'testData',
                'subgroup' => 'testData',
                'lockToDomain' => 'testData',
                'description' => 'testData',
                'TSconfig' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
            ],
            'NEW8' => [
                'hidden' => 'testData',
                'title' => 'testData',
                'subgroup' => 'testData',
                'lockToDomain' => 'testData',
                'description' => 'testData',
                'TSconfig' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
            ],
            'NEW9' => [
                'hidden' => 'testData',
                'title' => 'testData',
                'subgroup' => 'testData',
                'lockToDomain' => 'testData',
                'description' => 'testData',
                'TSconfig' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
            ],
            'NEW10' => [
                'hidden' => 'testData',
                'title' => 'testData',
                'subgroup' => 'testData',
                'lockToDomain' => 'testData',
                'description' => 'testData',
                'TSconfig' => 'testData',
                'tx_extbase_type' => 'testData',
                'felogin_redirectPid' => 'testData',
            ],
        ]
    ];

    /**
     * factory
     *
     * @var SeederFactory $factory
     */
    protected $factory = null;

    protected $faker;

    public function setUp()
    {
        $GLOBALS['TCA']['fe_users']['columns'] = unserialize('a:27:{s:8:"username";a:2:{s:5:"label";s:79:"LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_users.username";s:6:"config";a:5:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:3:"max";s:3:"255";s:4:"eval";s:39:"nospace,trim,lower,uniqueInPid,required";s:12:"autocomplete";b:0;}}s:8:"password";a:2:{s:5:"label";s:79:"LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_users.password";s:6:"config";a:6:{s:4:"type";s:5:"input";s:4:"size";s:2:"10";s:3:"max";i:100;s:4:"eval";s:77:"trim,required,TYPO3\CMS\Saltedpasswords\Evaluation\FrontendEvaluator,password";s:12:"autocomplete";b:0;s:10:"renderType";s:8:"rsaInput";}}s:9:"usergroup";a:2:{s:5:"label";s:80:"LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_users.usergroup";s:6:"config";a:8:{s:4:"type";s:6:"select";s:10:"renderType";s:24:"selectMultipleSideBySide";s:13:"foreign_table";s:9:"fe_groups";s:19:"foreign_table_where";s:24:"ORDER BY fe_groups.title";s:32:"enableMultiSelectFilterTextfield";b:1;s:4:"size";s:1:"6";s:8:"minitems";s:1:"1";s:8:"maxitems";s:2:"50";}}s:12:"lockToDomain";a:3:{s:7:"exclude";i:1;s:5:"label";s:83:"LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_users.lockToDomain";s:6:"config";a:5:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:4:"eval";s:4:"trim";s:3:"max";s:2:"50";s:7:"softref";s:10:"substitute";}}s:4:"name";a:3:{s:7:"exclude";i:1;s:5:"label";s:43:"LLL:EXT:lang/locallang_general.xlf:LGL.name";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"40";s:4:"eval";s:4:"trim";s:3:"max";s:2:"80";}}s:10:"first_name";a:3:{s:7:"exclude";i:1;s:5:"label";s:49:"LLL:EXT:lang/locallang_general.xlf:LGL.first_name";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"25";s:4:"eval";s:4:"trim";s:3:"max";s:2:"50";}}s:11:"middle_name";a:3:{s:7:"exclude";i:1;s:5:"label";s:50:"LLL:EXT:lang/locallang_general.xlf:LGL.middle_name";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"25";s:4:"eval";s:4:"trim";s:3:"max";s:2:"50";}}s:9:"last_name";a:3:{s:7:"exclude";i:1;s:5:"label";s:48:"LLL:EXT:lang/locallang_general.xlf:LGL.last_name";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"25";s:4:"eval";s:4:"trim";s:3:"max";s:2:"50";}}s:7:"address";a:3:{s:7:"exclude";i:1;s:5:"label";s:46:"LLL:EXT:lang/locallang_general.xlf:LGL.address";s:6:"config";a:3:{s:4:"type";s:4:"text";s:4:"cols";s:2:"20";s:4:"rows";s:1:"3";}}s:9:"telephone";a:3:{s:7:"exclude";i:1;s:5:"label";s:44:"LLL:EXT:lang/locallang_general.xlf:LGL.phone";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"eval";s:4:"trim";s:4:"size";s:2:"20";s:3:"max";s:2:"20";}}s:3:"fax";a:3:{s:7:"exclude";i:1;s:5:"label";s:42:"LLL:EXT:lang/locallang_general.xlf:LGL.fax";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:4:"eval";s:4:"trim";s:3:"max";s:2:"20";}}s:5:"email";a:3:{s:7:"exclude";i:1;s:5:"label";s:44:"LLL:EXT:lang/locallang_general.xlf:LGL.email";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:4:"eval";s:4:"trim";s:3:"max";s:3:"255";}}s:5:"title";a:3:{s:7:"exclude";i:1;s:5:"label";s:51:"LLL:EXT:lang/locallang_general.xlf:LGL.title_person";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:4:"eval";s:4:"trim";s:3:"max";s:2:"40";}}s:3:"zip";a:3:{s:7:"exclude";i:1;s:5:"label";s:42:"LLL:EXT:lang/locallang_general.xlf:LGL.zip";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"eval";s:4:"trim";s:4:"size";s:2:"10";s:3:"max";s:2:"10";}}s:4:"city";a:3:{s:7:"exclude";i:1;s:5:"label";s:43:"LLL:EXT:lang/locallang_general.xlf:LGL.city";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:4:"eval";s:4:"trim";s:3:"max";s:2:"50";}}s:7:"country";a:3:{s:7:"exclude";i:1;s:5:"label";s:46:"LLL:EXT:lang/locallang_general.xlf:LGL.country";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:4:"eval";s:4:"trim";s:3:"max";s:2:"40";}}s:3:"www";a:3:{s:7:"exclude";i:1;s:5:"label";s:42:"LLL:EXT:lang/locallang_general.xlf:LGL.www";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"eval";s:4:"trim";s:4:"size";s:2:"20";s:3:"max";s:2:"80";}}s:7:"company";a:3:{s:7:"exclude";i:1;s:5:"label";s:46:"LLL:EXT:lang/locallang_general.xlf:LGL.company";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"eval";s:4:"trim";s:4:"size";s:2:"20";s:3:"max";s:2:"80";}}s:5:"image";a:3:{s:7:"exclude";i:1;s:5:"label";s:44:"LLL:EXT:lang/locallang_general.xlf:LGL.image";s:6:"config";a:8:{s:4:"type";s:5:"group";s:13:"internal_type";s:4:"file";s:7:"allowed";s:48:"gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg";s:12:"uploadfolder";s:12:"uploads/pics";s:11:"show_thumbs";s:1:"1";s:4:"size";s:1:"3";s:8:"maxitems";s:1:"6";s:8:"minitems";s:1:"0";}}s:7:"disable";a:3:{s:7:"exclude";i:1;s:5:"label";s:46:"LLL:EXT:lang/locallang_general.xlf:LGL.disable";s:6:"config";a:1:{s:4:"type";s:5:"check";}}s:9:"starttime";a:3:{s:7:"exclude";i:1;s:5:"label";s:48:"LLL:EXT:lang/locallang_general.xlf:LGL.starttime";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"13";s:4:"eval";s:8:"datetime";s:7:"default";s:1:"0";}}s:7:"endtime";a:3:{s:7:"exclude";i:1;s:5:"label";s:46:"LLL:EXT:lang/locallang_general.xlf:LGL.endtime";s:6:"config";a:5:{s:4:"type";s:5:"input";s:4:"size";s:2:"13";s:4:"eval";s:8:"datetime";s:7:"default";s:1:"0";s:5:"range";a:1:{s:5:"upper";i:1609369200;}}}s:8:"TSconfig";a:4:{s:7:"exclude";i:1;s:5:"label";s:9:"TSconfig:";s:6:"config";a:4:{s:4:"type";s:4:"text";s:4:"cols";s:2:"40";s:4:"rows";s:2:"10";s:7:"softref";s:8:"TSconfig";}s:13:"defaultExtras";s:23:"fixed-font : enable-tab";}s:9:"lastlogin";a:3:{s:7:"exclude";i:1;s:5:"label";s:48:"LLL:EXT:lang/locallang_general.xlf:LGL.lastlogin";s:6:"config";a:5:{s:4:"type";s:5:"input";s:8:"readOnly";s:1:"1";s:4:"size";s:2:"12";s:4:"eval";s:8:"datetime";s:7:"default";i:0;}}s:15:"tx_extbase_type";a:3:{s:7:"exclude";i:1;s:5:"label";s:84:"LLL:EXT:extbase/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type";s:6:"config";a:6:{s:4:"type";s:6:"select";s:10:"renderType";s:12:"selectSingle";s:5:"items";a:2:{i:0;a:2:{i:0;s:86:"LLL:EXT:extbase/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.0";i:1;s:1:"0";}i:1;a:2:{i:0;s:121:"LLL:EXT:extbase/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_Extbase_Domain_Model_FrontendUser";i:1;s:36:"Tx_Extbase_Domain_Model_FrontendUser";}}s:4:"size";i:1;s:8:"maxitems";i:1;s:7:"default";s:1:"0";}}s:19:"felogin_redirectPid";a:3:{s:7:"exclude";i:1;s:5:"label";s:75:"LLL:EXT:felogin/Resources/Private/Language/Database.xlf:felogin_redirectPid";s:6:"config";a:7:{s:4:"type";s:5:"group";s:13:"internal_type";s:2:"db";s:7:"allowed";s:5:"pages";s:4:"size";i:1;s:8:"minitems";i:0;s:8:"maxitems";i:1;s:7:"wizards";a:1:{s:7:"suggest";a:1:{s:4:"type";s:7:"suggest";}}}}s:18:"felogin_forgotHash";a:3:{s:7:"exclude";i:1;s:5:"label";s:74:"LLL:EXT:felogin/Resources/Private/Language/Database.xlf:felogin_forgotHash";s:6:"config";a:1:{s:4:"type";s:11:"passthrough";}}}');
        $GLOBALS['TCA']['fe_groups']['columns'] = unserialize('a:8:{s:6:"hidden";a:3:{s:5:"label";s:46:"LLL:EXT:lang/locallang_general.xlf:LGL.disable";s:7:"exclude";i:1;s:6:"config";a:2:{s:4:"type";s:5:"check";s:7:"default";s:1:"0";}}s:5:"title";a:2:{s:5:"label";s:77:"LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_groups.title";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:3:"max";s:2:"50";s:4:"eval";s:13:"trim,required";}}s:8:"subgroup";a:3:{s:7:"exclude";i:1;s:5:"label";s:80:"LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_groups.subgroup";s:6:"config";a:9:{s:4:"type";s:6:"select";s:10:"renderType";s:24:"selectMultipleSideBySide";s:13:"foreign_table";s:9:"fe_groups";s:19:"foreign_table_where";s:87:"AND NOT(fe_groups.uid = ###THIS_UID###) AND fe_groups.hidden=0 ORDER BY fe_groups.title";s:32:"enableMultiSelectFilterTextfield";b:1;s:4:"size";i:6;s:11:"autoSizeMax";i:10;s:8:"minitems";i:0;s:8:"maxitems";i:20;}}s:12:"lockToDomain";a:3:{s:7:"exclude";i:1;s:5:"label";s:84:"LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:fe_groups.lockToDomain";s:6:"config";a:4:{s:4:"type";s:5:"input";s:4:"size";s:2:"20";s:4:"eval";s:4:"trim";s:3:"max";s:2:"50";}}s:11:"description";a:2:{s:5:"label";s:50:"LLL:EXT:lang/locallang_general.xlf:LGL.description";s:6:"config";a:3:{s:4:"type";s:4:"text";s:4:"rows";i:5;s:4:"cols";i:48;}}s:8:"TSconfig";a:4:{s:7:"exclude";i:1;s:5:"label";s:9:"TSconfig:";s:6:"config";a:4:{s:4:"type";s:4:"text";s:4:"cols";s:2:"40";s:4:"rows";s:2:"10";s:7:"softref";s:8:"TSconfig";}s:13:"defaultExtras";s:23:"fixed-font : enable-tab";}s:15:"tx_extbase_type";a:3:{s:7:"exclude";i:1;s:5:"label";s:85:"LLL:EXT:extbase/Resources/Private/Language/locallang_db.xlf:fe_groups.tx_extbase_type";s:6:"config";a:6:{s:4:"type";s:6:"select";s:10:"renderType";s:12:"selectSingle";s:5:"items";a:2:{i:0;a:2:{i:0;s:87:"LLL:EXT:extbase/Resources/Private/Language/locallang_db.xlf:fe_groups.tx_extbase_type.0";i:1;s:1:"0";}i:1;a:2:{i:0;s:127:"LLL:EXT:extbase/Resources/Private/Language/locallang_db.xlf:fe_groups.tx_extbase_type.Tx_Extbase_Domain_Model_FrontendUserGroup";i:1;s:41:"Tx_Extbase_Domain_Model_FrontendUserGroup";}}s:4:"size";i:1;s:8:"maxitems";i:1;s:7:"default";s:1:"0";}}s:19:"felogin_redirectPid";a:3:{s:7:"exclude";i:1;s:5:"label";s:75:"LLL:EXT:felogin/Resources/Private/Language/Database.xlf:felogin_redirectPid";s:6:"config";a:7:{s:4:"type";s:5:"group";s:13:"internal_type";s:2:"db";s:7:"allowed";s:5:"pages";s:4:"size";i:1;s:8:"minitems";i:0;s:8:"maxitems";i:1;s:7:"wizards";a:1:{s:7:"suggest";a:1:{s:4:"type";s:7:"suggest";}}}}}');

        $faker = $this->getMock(Faker::class);
        $faker->expects($this->any())->method('get')->willReturn('testData');

        $this->factory = GeneralUtility::makeInstance(SeederFactory::class, $faker);
    }

    /**
     * Test, if simple relation can be created
     *
     * @test
     */
    public function simpleRelation()
    {
        /** @var User $userSeed */
        $userSeed = GeneralUtility::makeInstance(User::class);
        $userSeed->run();
        $seedCollection = GeneralUtility::makeInstance(SeedCollection::class);

        $this->assertSame($this->expected, $seedCollection->toArray());
    }
}
