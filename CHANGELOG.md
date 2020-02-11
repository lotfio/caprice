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
- no error when sections not found