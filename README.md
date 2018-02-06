# seeder
[![Build Status](https://travis-ci.org/TildBJ/seeder.svg?branch=master)](https://travis-ci.org/TildBJ/seeder)

Seeder is a TYPO3 Extension that generates fake data for your TYPO3 Extension. Its intended for developers only!!! This Version is an experimental version!

## Installation

### via composer

The recommended way to install seeder is by using composer.
1. Get seeder by running
```sh
composer require tildbj/seeder
```
2. Activate seeder in your Extension Manager

### via Extensionmanager:

Faker requires [fzaninotto/faker](https://packagist.org/packages/fzaninotto/faker).
If you install seeder via Extensionmanager it's up to you to install fzaninotto/faker yourself.

## Usage

### Seeder class

Create a class wherever you want. Only make sure it's available via autoloader. Your class should look like this:
```php
<?php
namespace Dennis\Seeder\Seeder;

use Dennis\Seeder;

class Example extends \Dennis\Seeder\Seeder\DatabaseSeeder
{
    public function run()
    {
        $this->factory->create('tx_myextension_domain_model_mymodel')->each(function (Seeder\Seed $seed, Seeder\Faker $faker) {
            $seed->set(
                array (
                  'pid' => 1,
                  'sys_language_uid' => 0,
                  'hidden' => 0,
                  'title' => $faker->getTitle(),
                  'description' => $faker->getText(),
                  'relation' => $this->call(\Dennis\Seeder\Seeder\RelationExample::class),
                  'fal_image' => $this->call(\Dennis\Seeder\Seeder\Image::class),
                )
            );
        });
    }
}
```

Add column information to your seed by passing an array to ``` $seed->set([//your columns]) ```.
It's mandatory to provide the pid information, otherwise seeder is not able to generate any data.

### Create Seed via commandline:

It's also possible to create a class via cli. Just execute the following command:
```sh
/path/to/typo3/cli_dispatch.phpsh extbase seeder:make --class-name=Example --table-name=tx_myextension_domain_model_mymodel
```

Attention: This command creates a seed within the directory Classes/Seeder. It's recommended to move this class outside this extensions otherwise it could get lost after an extension update.

### Execute Seed:

```sh
/path/to/typo3/cli_dispatch.phpsh extbase seeder:seed \\Vendor\\Seeder\\Seeder\\Example
```

### Alias:

Create an alias in ext_localconf.php ``` ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['seeder']['alias']['myseed'] = \Dennis\Seeder\Seeder\Example::class;) ``` for running seed like this:
```sh
/path/to/typo3/cli_dispatch.phpsh extbase seeder:seed myseed
```

## Contributing

[Contribution guidelines for this project](.github/CONTRIBUTING.md)

## History

<table>
    <tr>
        <td>0.2.0</td>
        <td>
            * Seeds can now be available in custom namespaces
            * You can register own provider by extending global array in ext_localconf.php
            * When generating seeds cli won't ask for a fieldtype for every field
            * Update 3rd party extension
            * Several Bugfixes
        </td>
    </tr>
    <tr>
        <td>0.1.4</td>
        <td>Don't return empty properties</td>
    </tr>
    <tr>
        <td>0.1.3</td>
        <td>
            * Don't override Properties anymore when calling subseeds
            * Removes a Bug which leads to exponentially seeder calls
            * Don't instanciate abstract class, if field is called abstract
            * Add output decorator
            * Always ask for a pid even if there is no TCA configuration
        </td>
    </tr>
    <tr>
        <td>0.1.2</td>
        <td>Add TYPO3 8.7 support</td>
    </tr>
    <tr>
        <td>0.1.1</td>
        <td>Skip start and enddate because usually we don't want to test a typo3 core feature so each record will be available in frontend</td>
    </tr>
    <tr>
        <td>0.1.0</td>
        <td>First experimental release</td>
    </tr>
</table>

## Troubleshooting

Seeder does not create any data. What am i doing wrong?

* Make sure your seed has a pid that exists in your TYPO3 installation. Otherwise the extension is not able to generate any data.
* Checkout the Logmodule in the TYPO3 backend if there is any SQL error. It can help a lot to detect wrong configuration of your seed.

## Need Support?

Feel free to ask your questions on [Slack](https://typo3.slack.com/messages/C5P9XJ45A)

## License

Seeder is released under GNU General Public License, version 3 or later. See the bundled LICENSE file for details.
