<?php
namespace Dennis\Seeder;

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

/**
 * Interface Faker
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
 * @package Dennis\Seeder
 */
interface Faker
{
    /**
     * Returns random dummy data by property
     *
     * @param $property
     * @return mixed
     */
    public function get($property);

    /**
     * Guesses which provider will be returned by given property name
     *
     * @param $name
     * @return string
     */
    public function guessProviderName($name);
}
