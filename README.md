# seeder
[![Build Status](https://travis-ci.org/TildBJ/seeder.svg?branch=develop)](https://travis-ci.org/TildBJ/seeder.svg)

Seeder is a TYPO3 Extension that generates fake data for your TYPO3 testsystem.
Faker requires [fzaninotto/faker](https://packagist.org/packages/fzaninotto/faker).
For this version it's up to you to install fzaninotto/faker via composer since seeder is based on it.

## Installation

### via composer

```sh
composer require tildbj/seeder
```

### via Extensionmanager:

```sh
tbd
```

## Usage

### Create Seed via commandline:

```sh
/path/to/typo3/phpsh extbase seeder:make --class-name=Example --table-name=tx_myextension_domain_model_mymodel
```

### Execute Seed:

```sh
/path/to/typo3/phpsh extbase seeder:seed --class-name=Example
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