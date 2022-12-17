# MastodonBotPHP
![PHP](https://img.shields.io/badge/php-%3E%3D5.3-8892bf.svg)
![CURL](https://img.shields.io/badge/cURL-required-green.svg)

[![Total Downloads](https://poser.pugx.org/eleirbag89/mastodonbotphp/downloads)](https://packagist.org/packages/eleirbag89/mastodonbotphp)
[![License](https://poser.pugx.org/eleirbag89/mastodonbotphp/license)](https://packagist.org/packages/eleirbag89/mastodonbotphp)
[![StyleCI](https://styleci.io/repos/254720352/shield?branch=master)](https://styleci.io/repos/254720352)

A very simple PHP Mastodon API for sending statuses

Requirements
---------

* PHP >= 5.3
* Curl extension for PHP5 must be enabled.
* A Mastodon Application Client token. From Settings -> Development -> NEW APPLICATION enter a name and select the permissions, you will need **write:media**
to upload media files and **write:statuses** to publish statuses. "Your access token" contains the token.
* Some way to execute the script in order to serve messages (for example https://cron-job.org/)

Download
---------

#### Using Composer

From your project directory, run:
```
composer require eleirbag89/mastodonbotphp
```
or
```
php composer.phar require eleirbag89/mastodonbotphp
```
Note: If you don't have Composer you can download it [HERE](https://getcomposer.org/download/).

#### Using release archives

https://github.com/Eleirbag89/MastodonBotPHP/releases

#### Using Git

From a project directory, run:
```
git clone https://github.com/Eleirbag89/MastodonBotPHP.git
```

Installation
---------

#### Via Composer's autoloader

After downloading by using Composer, you can include Composer's autoloader:
```php
include (__DIR__ . '/vendor/autoload.php');

$mastodon = new Mastodon('YOUR APP TOKEN HERE', 'YOUR INSTANCE URL HERE');
```

#### Via Mastodon class

Copy Mastodon.php into your server and include it in your new bot script:
```php
include 'Mastodon.php';

$mastodon = new Mastodon('YOUR APP TOKEN HERE', 'YOUR INSTANCE URL HERE');
```

License
------------

This open-source software is distributed under the MIT License. See LICENSE.md

Contributing
------------

All kinds of contributions are welcome - code, tests, documentation, bug reports, new features, etc...

* Send feedbacks.
* Submit bug reports.
* Write/Edit the documents.
* Fix bugs or add new features.

Contact me
------------

You can contact me [via Mastodon Bida](https://mastodon.bida.im/@eleirbag) but if you have an issue please [open](https://github.com/Eleirbag89/MastodonBotPHP/issues) one.

Support me
------------

You can support me using via LiberaPay [![Donate using Liberapay](https://liberapay.com/assets/widgets/donate.svg)](https://liberapay.com/eleirbag89/donate)

or buy me a beer or two using [Paypal](https://paypal.me/eleirbag89). 
