# code block
- you can write any php inside code blocks

```php
    ((  
        $var1 = "foo";
        $var2 = "bar";
        echo $var1 . " and " . $var2;
     ))
```

# echo statement
- you sould use single quotes or duble quotes for strings otherwise it will be evaluated as a constant
```cpp
    (- " hello caprice " -)
```

# echo escaped statement
- echo with escape using UTF-8 charset
```cpp
    (= " hello caprice " =)
```

# array access
- you can access array keys using dot notation
```cpp
    $array.key  // evaluates $array["key"]
```

# if statement
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
     // iflogic

    #elif ($condition2)

      // elseif logic
    #else               
      // else logic
    #endif
```

# for in loop
- for in loop value only
```cpp
    // for in loop
    #for ($name in $array)
        (- $name -)
    #endfor
```
- for in loop key, value
```cpp
    // for in loop
    #for ($name => $age in $array)
        (- $name . '-' . $age -)
    #endfor
```

# for loop
- for loop syntax
```js
    // for loop
    #for ($i = 0; $i <= 10; $i++)
        (- $i . "<br>" -)
    #endfor
```

# while loop
- while loop syntax
```js
    // for loop
    #while (TRUE)
        (- " do something" -)
    #endwhile
```

# include / require statements
- while loop syntax
```js
 // include/require statments
    // you can remove .php extension for both
    // you use . to access folder instead of /
    #require("file.php")
    #include("file.php")
```