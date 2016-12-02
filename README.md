# DataRole API Client Library for PHP #

The DataRole API Client Library enables you to work with DataRole APIs on your server.

## Requirements ##
* [PHP 5.4.0 or higher](http://www.php.net/)

## Developer Documentation ##
https://github.com/DataRole/api

## Installation ##

You can simply **Download the Release**

### Download the Release

You can download the package in its entirety. The [Releases](https://github.com/DataRole/api-client-php/releases) page lists all stable versions. Download any file with the name for a package including this library and its dependencies.

Uncompress the zip file you download, and include the autoloader in your project:

```php
require_once '/path/to/datarole-api-php-client/vendor/autoload.php';
```

For additional installation and setup instructions, see [the documentation](https://github.com/datarole/api/blob/master/sdks/php.md#installation).

## Basic Example ##
Begin by editing the examples/index.php file and replacing the placeholder text with your provided account and secret keys.  If you want to test a specific address, just replace the default address in the lookupAddress() function. 

```PHP
// include your composer dependencies
require_once 'vendor/autoload.php';

$client = new DataRole\API\Client([
    'account' => '__ACCOUNT__',
    'secret'  => '__SECRET__',
    'version' => 'v2',
]);

$client
    ->lookupAddress('776+Buena+Vista+Ave+Alameda+CA+94501')
    ->printPreview();
```

You can then view the result in your browser by running the php built-in web server and then browsing to the host and port you specified (ie: `http://localhost:8000`).

```
$ php -S localhost:8000 -t examples/
```

## Frequently Asked Questions ##

### What do I do if something isn't working? ###

For support with the library the best place to ask is via the datarole-api-php-client tag on StackOverflow: http://stackoverflow.com/questions/tagged/datarole-api-php-client

If there is a specific bug with the library, please file an issue in the Github issues tracker, including a (minimal) example of the failing code and any specific errors retrieved.

### How do I contribute? ###

We accept contributions via Github Pull Requests, but all contributors need to be covered by the standard Apache Individual Contributor License Agreement: https://www.apache.org/licenses/icla.txt

## Code Quality ##

Run the PHPUnit tests with PHPUnit.

    phpunit tests/

## License ##

Copyright 2016 DataRole, LLC

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

> <http://www.apache.org/licenses/LICENSE-2.0>

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
