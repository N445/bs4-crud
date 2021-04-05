Installation
============

### Step 1: Download the Bundle

Edit your `package.json` file in your root dir

```json
{
  "repositories": [
    {
      "name": "oz/bs4crud",
      "type": "vcs",
      "url": "git@gitdev.nvl.fr:ozanges/dev-interne/ozbundles/oz-bs4crud.git"
    }
  ],
  "require": {
    // ...
    "oz/bs4crud": "dev-master",
    // ...
  }
}
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
    Oz\News\OzNewsBundle::class => ['all' => true],
```

### Symfony 4 maker for Bootstrap 4

Run ```php bin/console make:bs4crud```
