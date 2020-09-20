<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        hr {
            border: 0;
            border-top: 2px dashed#e2e1e1;
        }
    </style>
</head>
<body>

    <!-- code block -->
    #php 
        $names = ['foo', 'bar', 'baz'];
        $age   = 15; 
    #endphp

    <hr>
    <!-- if statement -->
    #if($age == 15)
        - age is {{ $age }}
    #endif
    <hr>
    <!-- else if statement -->
    #if($age == 10)
        - age is 10
    #elseif($age == 15)
        - age is {{ $age }}
    #endif

    <hr>
    <!-- for loop -->
    #for($i = 0; $i < count($names); $i++)
        - {{ $i }}  {{ $names[$i] }} <br>
    #endfor

    <hr>
    <!-- for in loop // alternative to foreach -->
    #for($indx => $name in $names)
        - {{ $indx }} {{ $name }} <br>
    #endforin

    <hr>
    <!-- while loop -->
    #php $i = 0 #endphp
    #while($i < count($names))

        - {{ $i }} {{ $names[$i] }} <br>

        #php $i++ #endphp 
    #endwhile

    <hr>
    <!-- do while loop -->
    #php $i = 0 #endphp
    #do

        - {{ $i }} {{ $names[$i] }} <br>

        #php $i++ #endphp 
    #enddo($i < count($names))

    <hr>
    <!-- break and continue loop -->

    #for($i = 0; $i < 10; $i++)
        #if($i == 3 || $i == 4) #continue #endif
        #if($i == 8) #break #endif
        - {{ $i }} <br>
    #endfor

    <hr>
    <!-- helpers -->
    #dump($names)
    #dd($names)

    <hr>
    <!-- include / require -->
    #include(_template)
    #require(_template)
    

</body>
</html>