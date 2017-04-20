# seeder
[![Build Status](https://travis-ci.org/TildBJ/seeder.svg?branch=develop)](https://travis-ci.org/TildBJ/seeder.svg)

Seeder is a TYPO3 Extension that generates fake data for your TYPO3 testsystem.

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

TODO: Write history

## License

Seeder is released under GNU General Public License, version 3 or later. See the bundled LICENSE file for details.