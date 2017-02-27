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
If you want to install a new module, you need a configuration file (([config/config.php](https://github.com/artdevue/phalcon-blank/blob/master/config/config.php))) to add a new record to the variable *'modules'*
```php
'newmodul' => [
    'dir' => PROJECT_PATH . 'apps/newmodul/',
    'className' => 'Apps\Newmodul\Module',
    'prefix_router' => false,
    'host_name' => false
]
```
- **newmodul**      - replaced by your module name
- **dir**           - location module directory
- **className**     - ClassName for new module
- **prefix_router** - URL prefix for the new router. If you write "news", then the module will be available with a URL address start with **/news**
- **host_name**     - This is the name by which the host will be available this module If left empty - then the module will use the default hostname. If you write "news.site.com" - then there will be a new module is available at URL http//news.site.com

After the configuration file settings using the terminal run the following command:
```bash
$ php apps/cli.php modules update
```
If there are new options for the new module, then by a hint system will install a new module

License
-------

This project is open-sourced software licensed under the MIT License.

See the LICENSE file for more information.

Authors
-------
<table>
  <tr>
    <td><img src="http://www.gravatar.com/avatar/39ef1c740deff70b054c1d9ae8f86d02?s=60"></td><td valign="middle">Valentin Rasulov<br>artdevue.com<br><a href="http://artdevue.com">http://artdevue.com</a></td>
  </tr>
</table>