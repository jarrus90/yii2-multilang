# Yii2-multilang 

[![Build Status](https://travis-ci.org/jarrus90/yii2-multilang.svg?branch=master)](https://travis-ci.org/jarrus90/yii2-multilang)

> **NOTE:** Module is in initial development. Anything may change at any time.

## Contributing to this project

Anyone and everyone is welcome to contribute. Please take a moment to review the [guidelines for contributing](CONTRIBUTING.md).

## License

Yii2-content is released under the BSD-3-Clause License. See the bundled [LICENSE.md](LICENSE.md) for details.

##Requirements

YII 2.0

##Installation

~~~php

"require": {
    "jarrus90/yii2-multilang": "*",
},

php composer.phar update
~~~

#Components
##Multilang request
Sets current user language as application language
~~~php
    'components' => [
        'request' => [
            'class' => 'jarrus90\Core\components\MultilangRequest'
        ],
    ]
~~~
Requires user identity having field `lang`
