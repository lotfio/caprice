<p align="center">
  <img src="https://github.com/lotfio/caprice/blob/master/docs/logo.png" width="200"  alt="caprice Preview">
  <p align="center">
    <img src="https://img.shields.io/badge/Licence-MIT-ffd32a.svg" alt="License">
    <img src="https://img.shields.io/badge/PHP-8-808e9b.svg" alt="PHP version">
    <img src="https://img.shields.io/badge/Version-1.1.2-f53b57.svg" alt="Version">
    <img src="https://img.shields.io/badge/coverage-98%25-27ae60.svg" alt="Coverage">
    <img src="https://jenkins.lotfio.net/buildStatus/icon?job=caprice+-+ci" alt="Build Status">
    <img src="https://jenkins.lotfio.net/buildStatus/icon?job=caprice+-+Psalm&subject=Psalm&color=darkturquoise" alt="Static Analysis">
    </p>
  <p align="center">
    <strong>:candy: easy weezy templating engine for php :candy:</strong>
  </p>
</p>

# :fire: Introduction :
Caprice is PHP templating engine that aims to write clean PHP syntax along side with HTML code.
caprice compiles the syntax and generate php files which means no performance loss but a clean html files with a friendly syntax.

# :pushpin: Requirements :
- PHP 8 or newer versions
- PHPUnit >= 9 (for testing purpose)

# :ok_hand: Features :
- easy to use.
- friendly syntax.
- caching (one time compile).
- no performance loss.

# :rocket: Installation & Use :
```php
    composer require lotfio/caprice
```

# 💥 testing :
```php
    composer test
```

# :pencil2: Usage :
```php

  use Caprice\Caprice;

  require 'vendor/autoload.php';

  $caprice = new Caprice;

  // load caprice predefined directives
  $caprice->loadPredefinedDirectives();

  // set views location and cache location
  $caprice->setCompileLocations('views', 'cache'); 

  // helpful for development environment
  $caprice->enableRecompile();
  
  // file to compile  => views/test.cap.php
  // you can remove .cap.php extension for both
  $compiled = $caprice->compile("test");

  require $compiled; // require your compiled file
```
# :inbox_tray: Available syntax directives:

### code block
- you can write any php inside code blocks

```cpp
    #php
        $var1 = "foo";
        $var2 = "bar";
        echo $var1 . " and " . $var2;
    #endphp
```

### echo statement
```cpp
    {{ " hello caprice " }}
```

### if statement
- if only
```cpp
   // if statement
    #if ($condition)

      // logic
    #endif
```
- if else
```cpp
   // if statement
    #if ($condition)
        // if logic
    #else
      // else logic
    #endif
```
- if elseif
```cpp
    #if ($condiftion)
     // if logic

    #elseif ($condition2)

      // elseif logic
    #else
      // else logic
    #endif
```

### for in loop
- for in loop value only
```cpp
    // for in loop key only
    #for ($name in $array)
        {{ $name }}
    #endforin
```
- for in loop key, value
```cpp
    // for in loop key value
    #for ($name => $age in $array)
        {{ $name }} => {{ $age }}
    #endforin
```

### for loop
- for loop syntax
```cpp
    // for loop
    #for ($i = 0; $i <= 10; $i++)
        {{ $i }} <br>
    #endfor
```

### while loop
- while loop syntax
```cpp
    // while loop
    #while ($condition)
        // loop
    #endwhile
```

### do while loop
- do while syntax
```cpp
    // do while 
    #do
        {{ "do something" }}
    #enddo($whileCondition)
```

### continue & break loop
```cpp
    // continue & break statements
    #while (TRUE)
        #if(condition) #continue #endif
        #if(another_condition) #break #endif
    #endwhile
```

### include / require statements
```cpp
    // include/require statements
    // you can remove .cap.php extension for both
    // you use . to access folder instead of /
    #require("file.cap.php")
    #include("file.cap.php")
```

### layout
```cpp
    // extends a base layout
    // here we are extending master.cap.php from layouts folder
    #extends("layouts.master")
    // load a section
    #yield("sectionName")

    // define a section
    #section("sectionName")
        // section content
    #endsection
```

### helpers
```cpp
    // functions
    // dump
    #dump($variable) OR #dd($variable)
```
# :hand: Custom directives:
 - you can define your custom directives:
 - ***make sure that the definition of your directives goes before calling compile***
 ```php

    // simple directives
    $caprice->directive("#test", function(){
        return 'replace test directive with this string';
    });

    // expression directive
    // example #call($var)
    $caprice->directive("#call", function(string $expression, string $match, array $extras){
        return '<?php call'. $expression . ';?>'; // this will evaluate to <?php call($var);\?\>
    });

    // class method directive
    // MyDirective class should implement DirectiveInterface
    $caprice->directive("#call", MyDirective::class);
```

# :helicopter: TODO
- Adding helpers
- Adding unit test helpers

# :computer: Contributing

- Thank you for considering to contribute to ***Caprice***. All the contribution guidelines are mentioned [here](CONTRIBUTING.md).

# :page_with_curl: ChangeLog

- Here you can find the [ChangeLog](CHANGELOG.md).

# :beer: Support the development

- Share ***Caprice*** and lets get more stars and more contributors.
- If this project helped you reduce time to develop, you can give me a cup of coffee :) : **[Paypal](https://www.paypal.me/lotfio)**. 💖

# :clipboard: License

- ***Caprice*** is an open-source software licensed under the [MIT license](LICENSE).
