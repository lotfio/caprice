<p align="center">
  <img src="https://github.com/lotfio/caprice/blob/master/docs/logo.png" width="200"  alt="caprice Preview">
  <p align="center">
    <img src="https://img.shields.io/badge/Licence-MIT-ffd32a.svg" alt="License">
    <img src="https://img.shields.io/badge/PHP-7.2-808e9b.svg" alt="PHP version">
    <img src="https://img.shields.io/badge/Version-0.3.0-f53b57.svg" alt="Version">
    <img src="https://img.shields.io/badge/coverage-10%25-27ae60.svg" alt="Coverage">
    <img src="https://travis-ci.org/lotfio/caprice.svg?branch=master" alt="Build Status">
    <img src="https://github.styleci.io/repos/211069554/shield?branch=master" alt="StyleCi">
    </p>
  <p align="center">
    <strong>:candy: easy weezy templating engine for php :candy:</strong>
  </p>
</p>

### :fire: Introduction :
Caprice is PHP templating engine that aims to write clean PHP syntax along side with HTML code.
caprice compiles the syntax and generate php files which means no performance loss but a clean html files with a friendly syntax.

### :pushpin: Requirements :
- PHP 7.2 or newer versions
- PHPUnit >= 8 (for testing purpose)

### :ok_hand: Features :
- easy to use.
- friendly syntax.
- caching (one time compilation only when files get edited).
- no performance loss.

### :rocket: Installation & Use :
```php
    composer require lotfio/caprice
```

### :pencil2: Usage :
```php
  require 'vendor/autoload.php';

  $compiler = new Caprice\Compiler("filesDirectory", "cacheDirectory");

  // if production do not forget to enable production mode
  //$compiler->setProductionMode();

  // add custom directives
  //$compiler->extendDirectives($dir);

  $compiled = $compiler->compile("test.cap.php"); // file to compile

  require $compiled; // require your compiled file
```

### :inbox_tray: Available syntax directives:
- check the documentation here [Docs](https://github.com/lotfio/caprice/blob/master/docs/exapmles.md).

### :helicopter: TODO
- Adding support for custom directives.

### :computer: Contributing

- Thank you for considering to contribute to ***Caprice***. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

### :page_with_curl: ChangeLog

- Here you can find the [ChangeLog](CHANGELOG.md).

### :beer: Support the development

- Share ***Caprice*** and lets get more stars and more contributors.
- If this project helped you reduce time to develop, you can give me a cup of coffee :) : **[Paypal](https://www.paypal.me/lotfio)**. 💖

### :clipboard: License

- ***Caprice*** is an open-source software licensed under the [MIT license](LICENSE).
