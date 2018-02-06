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
     * @throws NotFoundException
     */
    public function get($property)
    {
        if (!$provider = $this->guessProviderName($property)) {
            $provider = $property;
        }

        if (!$this->hasProvider($provider)) {
            throw new \Dennis\Seeder\Provider\NotFoundException(
                'No provider found for ' . $provider
            );
        }

        return $this->generate($provider);
    }

    /**
     * @return array
     */
    public function getSupportedProviders()
    {
        return $this->generator->getProviders();
    }

    /**
     * @param string $providerName
     * @return mixed
     */
    private function generate($providerName)
    {
        return $this->generator->$providerName;
    }

    /**
     * @param string $name
     * @return bool
     */
    private function hasProvider($name)
    {
        if (empty($name)) {
            return false;
        }
        if ($this->hasCustomProvider($name)) {
            return true;
        }
        try {
            if ($this->generator->getFormatter($name)) {
                return true;
            }
        } catch (\InvalidArgumentException $exception) {
            return false;
        }
        return false;
    }

    /**
     * @param string $className
     * @return mixed
     * @throws \Exception
     */
    private function callCustomProvider($className)
    {
        /** @var \Dennis\Seeder\Provider $providerClass */
        $providerClass = GeneralUtility::makeInstance($className, $this);
        if (!$providerClass instanceof \Dennis\Seeder\Provider) {
            throw new \Exception(get_class($providerClass) . ' must implement ' . \Dennis\Seeder\Provider::class);
        }
        return $providerClass->generate();
    }

    /**
     * @param string $name
     * @return bool
     */
    private function hasCustomProvider($name)
    {
        return (isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['seeder']['provider'][$name]) && class_exists(
                $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['seeder']['provider'][$name]
            ));
    }

    /**
     * @param string $name
     * @return string
     * @throws NotFoundException
     * @throws \Exception
     */
    public function guessProviderName($name)
    {
        if (empty($name)) {
            throw new \Dennis\Seeder\Provider\NotFoundException();
        }
        if (preg_match('/^is[_A-Z]/', $name)) {
            return 'boolean';
        }
        if (preg_match('/(_a|A)t$/', $name)) {
            return 'unixtime';
        }
        $name = GeneralUtility::strtolower($name);
        $name = str_replace('_', '', $name);
        if ($this->hasProvider($name)) {
            return $name;
        }
        switch ($name) {
            case 'mail':
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
     * @param $name
     * @param $value
     * @return mixed
     * @throws NotFoundException
     * @throws \Exception
     */
    public function __call($name, $value)
    {
        $propertyArray = explode('get', $name);
        $property = strtolower($propertyArray[1]);
        if ($this->hasCustomProvider($property)) {
            return $this->callCustomProvider($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['seeder']['provider'][$property]);
        }

        return $this->get($property);
    }
}
