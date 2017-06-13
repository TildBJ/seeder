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

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

<table>
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

## Need Support?

Feel free to ask your questions on [Slack](https://typo3.slack.com/messages/C5P9XJ45A)

## License

Seeder is released under GNU General Public License, version 3 or later. See the bundled LICENSE file for details.
