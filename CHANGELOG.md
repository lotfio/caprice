# Changelog

## 0.1.0
-  caprice templating engine first realease

## 0.2.0
-  adding new directives (#extends, #yield, #section, #dd, #dump)
-  adding environment ($compiler->setProductionMode())
-  adding Utils and helpers

## 0.3.0
- ability to add custom directives ($compiler->extendDirectives($dir))
- fix dot notaion array access on for in loops

## 0.4.0
- rename parse to parseSigle (as it applies one single diretive to the given file or string)
- rename parseFile to parse (as it applies all the directives to te given file or string)
- fix code block statement to avoid collision with multiple functions call
- no error when sections not found
- fix closing parenthesis when using a function in loops