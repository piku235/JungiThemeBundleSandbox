JungiBootstrapThemeBundle
================

The JungiBootstrapThemeBundle is an only demonstration bundle created in order to show how themes looks in the [JungiThemeBundle](https://github.com/piku235/JungiThemeBundle).
This bundle acts as a themes container, it provides two simple themes where the first one is designed for the **default**
environment and the second one designed for the **admin** environment.

Requirements
------------

The bundle uses the [JungiEnvironmentBundle](https://github.com/piku235/JungiEnvironmentBundle).

Installation
------------

### Step 1: Install bundle using composer

Add the JungiBootstrapThemeBundle in your composer.json:

```js
{
    "require": {
        "jungi/simple-theme-bundle": "dev-master"
    }
}
```

Or run the following command in your project:

```bash
$ php composer.phar require jungi/simple-theme-bundle "dev-master"
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

```php
<?php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Jungi\Bundle\BootstrapThemeBundle\JungiBootstrapThemeBundle(),
    );
}
```