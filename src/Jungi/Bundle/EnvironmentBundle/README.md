JungiEnvironmentBundle
============================

The JungiEnvironmentBundle is a great example which shows how the [JungiThemeBundle](https://github.com/piku235/JungiThemeBundle)
can cooperate with the Symfony2. The bundle contains a simple structure of environments which are used by controllers.
The resolved controller decides about an environment for a dispatched request. Thanks to that a theme resolver knows which
theme it should use.

Requirements
------------

The bundle uses the [JungiBootstrapThemeBundle](https://github.com/piku235/JungiBootstrapThemeBundle).

Installation
------------

### Step 1: Install bundle using composer

Add the JungiEnvironmentBundle in your composer.json:

```js
{
    "require": {
        "jungi/simple-environment-bundle": "dev-master"
    }
}
```

Or run the following command in your project:

```bash
$ php composer.phar require jungi/simple-environment-bundle "dev-master"
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
        new Jungi\Bundle\EnvironmentBundle\JungiEnvironmentBundle(),
    );
}
```

If you're installing this bundle as the first without having the JungiThemeBundle and the JungiBootstrapThemeBundle then
you have to add these bundles in the kernel, so finally the kernel should look like below:

```php
<?php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Jungi\Bundle\ThemeBundle\JungiThemeBundle(),
        new Jungi\Bundle\BootstrapThemeBundle\JungiBootstrapThemeBundle(),
        new Jungi\Bundle\EnvironmentBundle\JungiEnvironmentBundle(),
    );
}
```

### Step 3: Import the bundle routing

Import the bundle routing

```yml
# app/routing.yml
jungi_environment:
    resource: "@JungiEnvironmentBundle/Resources/config/routing.xml"
    prefix:   /env
```

Configuration
-------------

To get work with the bundle you must by first configure the JungiThemeBundle:

```yml
# app/config.yml
jungi_theme:
    holder:
        id: jungi_environment.context
    resolver:
        primary: jungi_environment.theme.resolver
```

And define environments for the JungiEnvironmentBundle:

```yml
# app/config.yml
jungi_environment:
    environments:
        admin:
            theme: footheme_admin
        default:
            theme: footheme
```