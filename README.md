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

### Create Seed via commandline:

```sh
/path/to/typo3/cli_dispatch.phpsh extbase seeder:make --class-name=Example --table-name=tx_myextension_domain_model_mymodel
```

### Customize Seed:

You can find your generated seed at: Classes/Seeder/Example.php
Feel free to customize it to your wishes. (A possiblity to configure the path is coming soon!!!)

### Execute Seed:

```sh
/path/to/typo3/cli_dispatch.phpsh extbase seeder:seed --class-name=Example
```

## Contributing

[Contribution guidelines for this project](.github/CONTRIBUTING.md)

## History

<table>
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
