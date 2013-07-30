BtnNewsBundle
=============

Temporary with hard coded twitter bootstrap html/css templates

=============

### Step 1: Add NewsBundle in your composer.json (private repo)

```js
{
    "require": {
        "bitnoise/news-bundle": "dev-master",
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@github.com:Bitnoise/BtnNewsBundle.git"
        }
    ],
}
```

### Step 2: Enable the bundle

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Btn\NewsBundle\BtnNewsBundle(),
    );
}
```

### Step 3: Import NewsBundle routing

``` yaml
# app/config/routing.yml
btn_news:
    resource: "@BtnNewsBundle/Controller/"
    type:     annotation
    prefix:   /
```

### Step 4: Update your database schema

``` bash
$ php app/console doctrine:schema:update --force
```