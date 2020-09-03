<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    {{ 'hello' }}

    #for($name => $age in $names)

        <div>
            <ul>
                <li>{{ $name }}</li>
            </ul>
        </div>

    #endforin

    #if ($name == 50)
        {{"nope"}}
    #endif

    #while(name == 10)
        {{ "hello" }}
    #endwhile


    #dowhile

    #enddowhile(success)


    



</body>
</html>