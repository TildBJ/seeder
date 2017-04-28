<?php
namespace Dennis\Seeder\Provider;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class Faker
 *
 * @method string getName()
 * @method string getFirstName()
 * @method string getFirstNameMale()
 * @method string getFirstNameFemale()
 * @method string getLastName()
 * @method string getTitle()
 * @method string getTitleMale()
 * @method string getTitleFemale()
 * @method string getCitySuffix()
 * @method string getStreetSuffix()
 * @method string getBuildingNumber()
 * @method string getCity()
 * @method string getStreetName()
 * @method string getStreetAddress()
 * @method string getPostcode()
 * @method string getAddress()
 * @method string getCountry()
 * @method string getLatitude()
 * @method string getLongitude()
 * @method string getEan13()
 * @method string getEan8()
 * @method string getIsbn13()
 * @method string getIsbn10()
 * @method string getPhoneNumber()
 * @method string getCompany()
 * @method string getCompanySuffix()
 * @method string getJobTitle()
 * @method string getCreditCardType()
 * @method string getCreditCardNumber()
 * @method string getCreditCardExpirationDate()
 * @method string getCreditCardExpirationDateString()
 * @method string getCreditCardDetails()
 * @method string getBankAccountNumber()
 * @method string getIban()
 * @method string getSwiftBicNumber()
 * @method string getVat()
 * @method string getWord()
 * @method string getWords()
 * @method string getSentence()
 * @method string getParagraph()
 * @method string getText()
 * @method string getRealText()
 * @method string getEmail()
 * @method string getSafeEmail()
 * @method string getFreeEmail()
 * @method string getCompanyEmail()
 * @method string getFreeEmailDomain()
 * @method string getSafeEmailDomain()
 * @method string getUserName()
 * @method string getPassword()
 * @method string getDomainName()
 * @method string getDomainWord()
 * @method string getTld()
 * @method string getUrl()
 * @method string getSlug()
 * @method string getIpv4()
 * @method string getIpv6()
 * @method string getLocalIpv4()
 * @method string getMacAddress()
 * @method string getUnixTime()
 * @method string getDateTime()
 * @method string getDateTimeAD()
 * @method string getIso8601()
 * @method string getDateTimeThisCentury()
 * @method string getDateTimeThisDecade()
 * @method string getDateTimeThisYear()
 * @method string getDateTimeThisMonth()
 * @method string getAmPm()
 * @method string getDayOfMonth()
 * @method string getDayOfWeek()
 * @method string getMonth()
 * @method string getMonthName()
 * @method string getYear()
 * @method string getCentury()
 * @method string getTimezone()
 * @method string getDate()
 * @method string getTime()
 * @method string getMd5()
 * @method string getSha1()
 * @method string getSha256()
 * @method string getLocale()
 * @method string getCountryCode()
 * @method string getCountryISOAlpha3()
 * @method string getLanguageCode()
 * @method string getCurrencyCode()
 * @method string getBoolean()
 * @method string getRandomDigit()
 * @method string getRandomDigitNotNull()
 * @method string getRandomLetter()
 * @method string getRandomAscii()
 * @method string getRandomNumber()
 * @method string getRandomFloat()
 * @method string getMacProcessor()
 * @method string getLinuxProcessor()
 * @method string getUserAgent()
 * @method string getChrome()
 * @method string getFirefox()
 * @method string getSafari()
 * @method string getOpera()
 * @method string getInternetExplorer()
 * @method string getWindowsPlatformToken()
 * @method string getMacPlatformToken()
 * @method string getLinuxPlatformToken()
 * @method string getUuid()
 * @method string getMimeType()
 * @method string getFileExtension()
 * @method string getImageUrl()
 * @method string getHexColor()
 * @method string getSafeHexColor()
 * @method string getRgbColor()
 * @method string getRgbCssColor()
 * @method string getSafeColorName()
 * @method string getColorName()
 *
 * @package Dennis\Seeder\Provider\Faker
 */
class Faker implements \Dennis\Seeder\Faker
{
    /** @var \Faker\Generator $generator */
    protected $generator = null;

    /** @var \Faker\Guesser\Name $guesser */
    protected $guesser = null;

    /**
     * @var array
     */
    protected $supportedProviders = [
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

    /**
     * Fields we don't take care of
     *
     * @var array $skippedProvider
     */
    public static $skippedProvider = [
        'l10n_parent',
        'l10n_diffsource',
        'cruser_id',
        'TSconfig',
        'tx_extbase_type',
        'felogin_redirectPid',
        't3ver_label',
        'starttime',
        'endtime',
    ];

    /**
     * Faker constructor.
     */
    public function __construct(\Faker\Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * Returns random dummy data by property
     *
     * @param string $property
     * @return mixed
     */
    public function get($property)
    {
        $provider = $this->guessProvider($property);
        $providerName = $this->getProviderNameByKey($provider);

        if ($providerName === null) {
            return '';
        }

        return $this->generator->$providerName;
    }

    /**
     * @return array
     */
    public function getSupportedProviders()
    {
        return $this->supportedProviders;
    }

    /**
     * @param $name
     * @return string ProviderName
     */
    public function guessProvider($name)
    {
        if (preg_match('/^is[_A-Z]/', $name)) {
            return 'boolean';
        }
        if (preg_match('/(_a|A)t$/', $name)) {
            return 'unixtime';
        }
        $name = GeneralUtility::strtolower($name);
        $name = str_replace('_', '', $name);
        if (array_key_exists($name, $this->supportedProviders)) {
            return $name;
        }
        switch ($name) {
            case 'emailaddress':
                return 'email';
            case 'phone':
            case 'telephone':
            case 'fax':
            case 'telnumber':
                return 'phonenumber';
            case 'town':
                return 'city';
            case 'zipcode':
            case 'zip':
                return 'postcode';
            case 'currency':
                return 'currencycode';
            case 'website':
                return 'url';
            case 'companyname':
            case 'employer':
                return 'company';
            case 'body':
            case 'bodytext':
            case 'summary':
            case 'teaser':
            case 'article':
            case 'description':
                return 'text';
            case 'middlename':
                return 'name';
            case 'uri':
            case 'www':
                return 'url';
            case 'image':
                return 'imageurl';
            case 'lastlogin':
            case 'crdate':
            case 'tstamp':
                return 'unixtime';
            case 'disable':
                return 'boolean';
            // Default provider is text:
            default:
                return null;
        }
    }

    /**
     * @param $key
     * @return mixed
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentValueException
     */
    public function getProviderNameByKey($key = null)
    {
        if (is_null($key)) {
            return null;
        }
        if ($key === '') {
            throw new \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentValueException(
                '$key must be set'
            );
        }
        if (!array_key_exists($key, $this->supportedProviders)) {
            throw new \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentValueException(
                sprintf('%s is not a supported key', $key)
            );
        }

        return $this->supportedProviders[$key];
    }

    public function __call($name, $value)
    {
        $propertyArray = explode('get', $name);
        $property = strtolower($propertyArray[1]);

        return $this->get($property);
    }
}
