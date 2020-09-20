# code block
- you can write any php inside code blocks

```cpp
    #php
        $var1 = "foo";
        $var2 = "bar";
        echo $var1 . " and " . $var2;
    #endphp
```

# echo statement
```cpp
    {{ " hello caprice " }}
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
     // if logic

    #elseif ($condition2)

      // elseif logic
    #else
      // else logic
    #endif
```

# for in loop
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

# for loop
- for loop syntax
```cpp
    // for loop
    #for ($i = 0; $i <= 10; $i++)
        {{ $i }} <br>
    #endfor
```

# while loop
- while loop syntax
```cpp
    // while loop
    #while ($condition)
        // loop
    #endwhile
```

# do while loop
- do while syntax
```cpp
    // do while 
    #do
        {{ "do something" }}
    #enddo($whileCondition)
```

# continue & break loop
```cpp
    // continue & break statements
    #while (TRUE)
        #if(condition) #continue #endif
        #if(another_condition) #break #endif
    #endwhile
```

# include / require statements
```cpp
    // include/require statements
    // you can remove .cap.php extension for both
    // you use . to access folder instead of /
    #require("file.cap.php")
    #include("file.cap.php")
```

# layout
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

# helpers
```cpp
    // functions
    // dump
    #dump($variable) OR #dd($variable)
```