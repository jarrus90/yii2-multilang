###Requirements

YII 2.0

###Installation

~~~php

"require": {
    "jarrus90/yii2-multilang": "*",
},

php composer.phar update
~~~

#Components
###Multilang request
Sets current user language as application language
~~~php
    'components' => [
        'request' => [
            'class' => 'jarrus90\Core\components\MultilangRequest'
        ],
    ]
~~~
Requires user identity having field `lang`
