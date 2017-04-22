# Phalcon Boilerplate (Currently project is under development)
=========
** This is a Boilerplate application written on Phalcon framework for the performance boost. This project created to develop applications in an easy way. 
   
   Have fun :) 

How to install
--------------

### Using Composer (*recommended*)

Best way to install Boilerplate would be Composer, if you didn't install it

Run code in the terminal:

```bash
composer create-project artdevue/phalcon-blank /path/to/install
composer update
bower update
```

### Using Git

First you need to clone the project, update vendors:

```bash
git clone https://github.com/artdevue/phalcon-blank.git ./project
cd project
composer update
bower update
```

Requirements
------------

* PHP 5.5.x/5.6.x/7.0.x development resources (PHP 5.3 and 5.4 are no longer supported)
* Phalcon **3.0.2**

Features
--------
After setup you’ll have multimodule apps.
* API RESTful module - responds all JSON-like requests.
* BACKEND and FRONTEND - A multi-module application uses the same document root for more than one module.

### Installing the module
If you want to install a new module, you need using the terminal run the following command
```bash
$ php apps/cli.php modules create modulename
```
**modulename** - replace it with the name of the module

For example, after executing the commands below in a terminal
```bash
$ php apps/cli.php modules create catalog
```
In the terminal, we see the report module installation
```bash
$ php apps/cli.php modules create catalog
Do you really want to install the module catalog?  Type 'yes' to continue: yes

Thank you, continuing...
Reading configuration file...
Creating a backup of the configuration file...
Record changes in the configuration file...
Create directories and files for this new module...
Installing the module is complete!
Use with pleasure!
```
After installing new module will be immediately available at http://site.com/catalog

The syntax of this command:
```bash
$ php apps/cli.php modules create $nameModule $prefixRouter $hostName
```
- **$nameModule** - (*String - Required value!*) Your module name
- **$prefixRouter** - (*String*) If the router prefix different from the module name, then enter here. If If you select - **null** - then there will be no prefix.
- **$hostName**     - (*String*) Host Name, if you want to have your module on another host. For example: http://catalog.site.com

### Using Multilanguage
* You must activate the "**multilang => true**" option in the configuration file.
* Parameter "**default_lang => 'en'**" is assigned the default language (_now is en_)
* Add an array of used languages in the project to the "languages" parameter of the configuration file
1. The default language is displayed in URL address without prefixes. For example: 
```html
site.com, site.com/page
```
2. If another language is used, then the prefix should be added at the beginning of the URL address. For example:
```html
site.com/ua, site.com/ua/page
```
3. Active language is called via config: In Controller **$this->config->lang_active** and in Volt **config.lang_active**

### Using Translation
All files for translation are located in the directory specified in the configuration file with the parameter: 
**name_lang_folder** (default is the folder **_lang_**) 
and in the subfolder of the default language in the configuration file with the parameter: 
**default_lang** (default lang **_en_**)

The variable name consists of the file names and array keys in the file section.

The example of use in the controller:
```php
$accepted = $this->trans->_("validation.accepted", ['attribute' => 'test']);
```
The example of use in the template volt:
```html
{{ trans._("validation.accepted", ['attribute': 'test']) }}
```

License
-------

The MIT License (MIT). Please see [License File](LICENSE) for more information.

Authors
-------
<table>
  <tr>
    <td><img src="http://www.gravatar.com/avatar/39ef1c740deff70b054c1d9ae8f86d02?s=60"></td><td valign="middle">Valentin Rasulov<br>artdevue.com<br><a href="http://artdevue.com">http://artdevue.com</a></td>
  </tr>
</table>