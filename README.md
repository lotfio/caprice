<p align="center">
  <img src="https://github.com/lotfio/caprice/blob/master/docs/logo.png" width="200"  alt="caprice Preview">
  <p align="center">
    <img src="https://img.shields.io/badge/Licence-MIT-ffd32a.svg" alt="License">
    <img src="https://img.shields.io/badge/PHP-7.2-808e9b.svg" alt="PHP version">
    <img src="https://img.shields.io/badge/Version-0.1.0-f53b57.svg" alt="Version">
    <img src="https://img.shields.io/badge/coverage-10%25-27ae60.svg" alt="Coverage">
    <img src="https://travis-ci.org/lotfio/skeleton.svg?branch=master" alt="Build Status">
    <img src="https://github.styleci.io/repos/206574643/shield?branch=master" alt="StyleCi">
    </p>
  <p align="center">
    <strong>:candy: easy weezy templating engine for php :candy:</strong>
  </p>
</p>

### :fire: Introduction :
introduction

### :pushpin: Requirements :
- PHP 7.2 or newer versions
- PHPUnit >= 8 (for testing purpose)

### :ok_hand: Features :
- Feature here

### :rocket: Installation & Use :
```php
    composer require lotfio/caprice
```

### :wrench: Configuration:
```php
  // configuration example
```

### :pencil2: Usage :
```php
  require 'vendor/autoload.php';

  $file     = "test.cap.php"; // caprice file example 

  $compiler = new Caprice\Compiler;
  $compiled = $compiler->compile($file, "./cacheLocation/"); // this will return a path to the compiled file

  require $compiled; // require your compiled file 
```

### :inbox_tray: Short explanation :
```php
  // additional details
```

### :computer: Contributing

- Thank you for considering to contribute to ***Caprice***. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

### :page_with_curl: ChangeLog

- Here you can find the [ChangeLog](CHANGELOG.md).

### :beer: Support the development

- Share ***Caprice*** and lets get more stars and more contributors.
- If this project helped you reduce time to develop, you can give me a cup of coffee :) : **[Paypal](https://www.paypal.me/lotfio)**. 💖

### :clipboard: License

- ***Caprice*** is an open-source software licensed under the [MIT license](LICENSE).
