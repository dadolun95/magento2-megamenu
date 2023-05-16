# Dadolun_MegaMenu module for Magento 2 <img src="https://avatars.githubusercontent.com/u/168457?s=40&v=4" alt="magento" />

## Features
This module add custom Magento menu management without theme customization or extra configurations.
The idea is to give a simple dependency tool letting free frontend customization to developers. 
Here it is the feature list:
- let you define a completely custom menus (using cms pages and links instead of only categories) and use it instead of magento's default 
- you can create different menu items for each menu and specify dimensions (1 column / 2 columns / 3 columns) for each item dropdown.
- add a "category nav" widget that print an html list of categories starting from selected one (useful for category three inclusion into a custom menu dropdown but also for cms blocks into your site)
- add a "menu nav" widget that print the custom menu content (useful for submenu inclusion into a custom menu dropdown but also for cms blocks into your site)

## Installation
You can install this module adding it on app/code folder or with composer.
##### COMPOSER
You need to update your composer.json "repositories" node:
```
{
    "type": "vcs",
    "url":  "git@github.com:dadolun95/magento2-megamenu.git"
}
```
Then execute this command:
```
composer require dadolun95/magento2-megamenu
```
Then you'll need to enable the module and update your database:
```
php bin/magento module:enable Dadolun_MegaMenu
php bin/magento setup:upgrade
```
##### SOURCE CODE
If you choose to add the module from source code instead of using composer you need to add module's files on your app/code folder.
Then enable it and update the database:
```
php bin/magento module:enable Dadolun_MegaMenu
php bin/magento setup:upgrade
```
##### CONFIGURATION
This module comes with standard functionality disabled. You'll need to enable it from configurations on ___Store > Configuration > Dadolun > Dadolun MegaMenu > Enable Dadolun MegaMenu as main MegaMenu___ . 
You can ceate your custom menus from __Content > Design > MegaMenu__, here you must set a name and assign the menu to desired scopes and save it, then you'll be able to create menu items.

## Contributing
Contributions are very welcome. In order to contribute, please fork this repository and submit a [pull request](https://docs.github.com/en/free-pro-team@latest/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request).
