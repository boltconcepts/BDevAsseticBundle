# BDevAsseticBundle

This bundle extends the [Symfony2 AsseticBundle](https://github.com/symfony/AsseticBundle) with some tweaks and hacks.

[![Build Status](https://travis-ci.org/boltconcepts/BDevAsseticBundle.png?branch=master)](https://travis-ci.org/boltconcepts/BDevAsseticBundle)

## LessPHP

Add's a `load_paths` configuration option to the `LessphpFilter`.

```yaml
#app/config/config.yml
assetic:
  filters:
    lessphp:
      .....
      load_paths: [ "%kernel.root_dir%/../vendor/fortawesome/", "%kernel.root_dir%/../vendor/twitter/", "%kernel.root_dir%/../vendor/jschr/" ]
```

## FontDirectoryFormulaLoader

This formula loader add's the hack/ability to copy a directory with font files to `font/`.

```yaml
assetic.font_awesome.fonts:
  class: %assetic.font_directory_resource.class%
    arguments:
      - "my/dir/" # Change this to the directory with your font files
    tags:
      - { name: assetic.formula_resource, loader: font_directory_loader }
```
*The FontDirectoryFormulaLoader is a hack but it can make managing things like [Font Awesome](http://fortawesome.github.com/Font-Awesome/) easy*