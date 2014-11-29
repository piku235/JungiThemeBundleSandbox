JungiThemeBundle Sandbox
========================

This sandbox is nothing other than a test platform of the [JungiThemeBundle](https://github.com/piku235/JungiThemeBundle).
It's based on the [Symfony Standard Edition](https://github.com/symfony/symfony-standard). It comes with two prebuilt
bundles and it's fully configured - only you have to do is to download and run it.

Getting started
---------------

### Installing with composer

The installation is very simple and fast, you have to only execute the following command.

```bash
$ php composer.phar create-project jungi/theme-bundle-sandbox dest_path @dev
```

### Running the sandbox

The easiest way is to run the internal web server provided by PHP. You can do it by executing the following command in 
your root directory of the project:

```bash
$ php app/console server:run
```

After that the sandbox should be accessible under the `http://localhost:8000` url.

The second way is to run the full featured web server like Apache. To get working the sandbox under the Apache you will 
need to create a virtual host and save the host name to your hosts file.

```
<VirtualHost *:80>
    ServerName jungi-sandbox.local
    ServerAlias www.jungi-sandbox.local

    DocumentRoot /var/www/project/web
    <Directory /var/www/project/web>
        AllowOverride All
        Order allow,deny
        Allow from All
    </Directory>
</VirtualHost>
```

If everything has gone well you should be able to access the sandbox by the `http://jungi-sandbox.local` url.
