# code block
- you can write any php inside code blocks

```js
    (<
        $var1 = "foo";
        $var2 = "bar";
        echo $var1 . " and " . $var2;
     >)
```

# echo statement
- you sould use single quotes or duble quotes for strings otherwise it will be evaluated as a constant
```js
    (- " hello caprice " -)
```

# echo escaped statement
- echo with escape using UTF-8 charset
```js
    (= " hello caprice " =)
```

# array access
- you can access array keys using dot notation
```js
    $array.key  // evaluates $array["key"]
```

# if statement
- if only
```js
   // if statement
    #if ($condition)

      // logic
    #endif
```
- if else
```js
   // if statement
    #if ($condition)
        // if logic
    #else
      // else logic
    #endif
```
- if elseif
```js
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
```js
    // for in loop key only
    #for ($name in $array)
        (- $name -)
    #endfor
```
- for in loop key, value
```js
    // for in loop key value
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
    // while loop
    #while (TRUE)
        (- " do something" -)
    #endwhile
```

# do while loop
- do while syntax
```js
    // do while 
    #do
        (- " do something" -)
    #while(TRUE)
```

# continue & break loop
```js
    // continue & break statments
    #while (TRUE)
        #if(condition) #continue
        #if(annother_condition) #break
    #endwhile
```

# include / require statements
```js
    // include/require statments
    // you can remove .cap.php extension for both
    // you use . to access folder instead of /
    #require("file.cap.php")
    #include("file.cap.php")
```

# layout directives
```js
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

# available functions
```js
    // functions
    // dump
    #dump($variable) OR #dd($variable)
```