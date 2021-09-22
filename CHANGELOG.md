# Changelog

## 1.1.0
- Fix issue with compile path (extends + include always start from base path)
- require minimum stable

## 1.1.0
- migrating ci to jenkins
- adding Psalm for static analysis (fixing some bits of code)
- adding php 8 support
- upgrading phpunit version 9

## 1.0.0
- first stable release v1
- ability to define custom directives (callback or class method)
- escaped output UTF-8
- recompile on file change only
- 99% test coverage

## 0.4.0
- rename parse to parseSingle (as it applies one single directive to the given file or string)
- rename parseFile to parse (as it applies all the directives to te given file or string)
- fix code block statement to avoid collision with multiple functions call
- no error when sections not found
- fix closing parenthesis when using a function in loops

## 0.3.0
- ability to add custom directives ($compiler->extendDirectives($dir))
- fix dot notation array access on for in loops

## 0.2.0
-  adding new directives (#extends, #yield, #section, #dd, #dump)
-  adding environment ($compiler->setProductionMode())
-  adding Utils and helpers

## 0.1.0
-  caprice templating engine first release