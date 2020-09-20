<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- code block -->
    #php 
        $names = ['foo', 'bar', 'baz'];
        $age   = 15; 
    #endphp

    <hr>
    <!-- for loop -->
    #for($i = 0; $i < count($names); $i++)
        - {{ $i }}  {{ $names[$i] }} <br>
    #endfor

    <hr>
    <!-- for  in loop -->
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

</body>
</html>