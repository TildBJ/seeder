<?php
namespace Dennis\Seeder\Tests\Provider;

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
use Dennis\Seeder\Provider\Faker;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Test case for class \Dennis\Seeder\Provider\Faker
 *
 * @author Dennis Römmich <dennis@roemmich.eu>
 */
class FakerTest extends UnitTestCase
{
    /**
     * @var Faker $subject
     */
    protected $subject;

    /**
     * setUp
     *
     * @return void
     */
    public function setUp()
    {
        $generator = $this->getMock(\Faker\Generator::class);
        $generator->name = 'Middle Name';
        $generator->city = 'City';
        $generator->company = 'Company Ltd.';

        $this->subject = new Faker($generator);
    }

    /**
     * getSupportedProvidersReturnsArrayWithProviders
     *
     * @method getSupportedProviders
     * @test
     */
    public function getSupportedProvidersReturnsArrayWithProviders()
    {
        $expected = [
            'name' => 'name',
            'firstname' => 'firstName',
            'firstnamemale' => 'firstNameMale',
            'firstnamefemale' => 'firstNameFemale',
            'lastname' => 'lastName',
            'title' => 'title',
            'titlemale' => 'titleMale',
            'titlefemale' => 'titleFemale',
            'citysuffix' => 'citySuffix',
            'streetsuffix' => 'streetSuffix',
            'buildingnumber' => 'buildingNumber',
            'city' => 'city',
            'streetname' => 'streetName',
            'streetaddress' => 'streetAddress',
            'postcode' => 'postcode',
            'address' => 'address',
            'country' => 'country',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'ean13' => 'ean13',
            'ean8' => 'ean8',
            'isbn13' => 'isbn13',
            'isbn10' => 'isbn10',
            'phonenumber' => 'phoneNumber',
            'company' => 'company',
            'companysuffix' => 'companySuffix',
            'jobtitle' => 'jobTitle',
            'creditcardtype' => 'creditCardType',
            'creditcardnumber' => 'creditCardNumber',
            'creditcardexpirationdate' => 'creditCardExpirationDate',
            'creditcardexpirationdatestring' => 'creditCardExpirationDateString',
            'creditcarddetails' => 'creditCardDetails',
            'bankaccountnumber' => 'bankAccountNumber',
            'iban' => 'iban',
            'swiftbicnumber' => 'swiftBicNumber',
            'vat' => 'vat',
            'word' => 'word',
            'words' => 'words',
            'sentence' => 'sentence',
            'paragraph' => 'paragraph',
            'text' => 'text',
            'realtext' => 'realText',
            'email' => 'email',
            'safeemail' => 'safeEmail',
            'freeemail' => 'freeEmail',
            'companyemail' => 'companyEmail',
            'freeEmaildomain' => 'freeEmailDomain',
            'safeEmaildomain' => 'safeEmailDomain',
            'username' => 'userName',
            'password' => 'password',
            'domainname' => 'domainName',
            'domainword' => 'domainWord',
            'tld' => 'tld',
            'url' => 'url',
            'slug' => 'slug',
            'ipv4' => 'ipv4',
            'ipv6' => 'ipv6',
            'localipv4' => 'localIpv4',
            'macaddress' => 'macAddress',
            'unixtime' => 'unixTime',
            'datetime' => 'dateTime',
            'datetimead' => 'dateTimeAD',
            'iso8601' => 'iso8601',
            'datetimethiscentury' => 'dateTimeThisCentury',
            'datetimethisdecade' => 'dateTimeThisDecade',
            'datetimethisyear' => 'dateTimeThisYear',
            'datetimethismonth' => 'dateTimeThisMonth',
            'ampm' => 'amPm',
            'dayofmonth' => 'dayOfMonth',
            'dayofweek' => 'dayOfWeek',
            'month' => 'month',
            'monthname' => 'monthName',
            'year' => 'year',
            'century' => 'century',
            'timezone' => 'timezone',
            'date' => 'date',
            'time' => 'time',
            'md5' => 'md5',
            'sha1' => 'sha1',
            'sha256' => 'sha256',
            'locale' => 'locale',
            'countrycode' => 'countryCode',
            'countryisoalpha3' => 'countryISOAlpha3',
            'languagecode' => 'languageCode',
            'currencycode' => 'currencyCode',
            'boolean' => 'boolean',
            'randomdigit' => 'randomDigit',
            'randomdigitnotnull' => 'randomDigitNotNull',
            'randomletter' => 'randomLetter',
            'randomascii' => 'randomAscii',
            'randomnumber' => 'randomNumber',
            'randomfloat' => 'randomFloat',
            'macprocessor' => 'macProcessor',
            'linuxprocessor' => 'linuxProcessor',
            'useragent' => 'userAgent',
            'chrome' => 'chrome',
            'firefox' => 'firefox',
            'safari' => 'safari',
            'opera' => 'opera',
            'internetexplorer' => 'internetExplorer',
            'windowsplatformtoken' => 'windowsPlatformToken',
            'macplatformtoken' => 'macPlatformToken',
            'linuxplatformtoken' => 'linuxPlatformToken',
            'uuid' => 'uuid',
            'mimetype' => 'mimeType',
            'fileextension' => 'fileExtension',
            'imageurl' => 'imageUrl',
            'hexcolor' => 'hexColor',
            'safehexcolor' => 'safeHexColor',
            'rgbcolor' => 'rgbColor',
            'rgbcsscolor' => 'rgbCssColor',
            'safecolorname' => 'safeColorName',
            'colorname' => 'colorName',
        ];

        $this->assertSame($expected, $this->subject->getSupportedProviders());
    }

    /**
     * @return array
     */
    public function propertyNameProvider()
    {
        return [
            ['emailaddress', 'email'],
            ['phone', 'phonenumber'],
            ['telephone', 'phonenumber'],
            ['telnumber', 'phonenumber'],
            ['fax', 'phonenumber'],
            ['town', 'city'],
            ['zipcode', 'postcode'],
            ['currency', 'currencycode'],
            ['website', 'url'],
            ['companyname', 'company'],
            ['employer', 'company'],
            ['body', 'text'],
            ['bodytext', 'text'],
            ['summary', 'text'],
            ['article', 'text'],
            ['teaser', 'text'],
            ['description', 'text'],
            ['middlename', 'name'],
            ['www', 'url'],
            ['uri', 'url'],
            ['image', 'imageurl'],
            ['lastlogin', 'unixtime'],
            ['starttime', 'unixtime'],
            ['crdate', 'unixtime'],
            ['tstamp', 'unixtime'],
            ['datetime', 'datetime'],
            ['endtime', 'unixtime'],
            ['disable', 'boolean'],
            ['created_at', 'unixtime'],
            ['createdAt', 'unixtime'],
            ['is_active', 'boolean'],
            ['isActive', 'boolean'],
            ['companysuffix', 'companysuffix'],
            ['creditcardexpirationdatestring', 'creditcardexpirationdatestring'],
            ['address', 'address'],
            // Default provider is null:
            ['foobar', null],
        ];
    }

    /**
     * @method get
     * @test
     */
    public function getReturnsGeneratedTestData()
    {
        $this->assertSame('Middle Name', $this->subject->get('middle_name'));
        $this->assertSame('City', $this->subject->get('city'));
        $this->assertSame('Company Ltd.', $this->subject->get('companyname'));
    }

    /**
     * @param $property
     * @param $expected
     * @dataProvider propertyNameProvider
     * @method guessProvider
     * @test
     */
    public function guessProviderReturnsExpectedProvider($property, $expected)
    {
        $this->assertSame($expected, $this->subject->guessProvider($property));
    }

    /**
     * @method getProviderNameByKey
     * @test
     */
    public function guessProviderNameByKeyWithInvalidArgumentThrowsException()
    {
        $this->setExpectedException(
            \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentValueException::class
        );
        $this->subject->getProviderNameByKey('');
    }
}
