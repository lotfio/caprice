#extends('_inc.main')
#require('_inc.header')

#section('content')
(<
    class Algeria
    {
        public $id = 10;

        public function getId()
        {
            return $this->id;
        }

        public $names =
            array(
            "rida",
            "ahmed"
             );

        public static function getII(int $id)
        {
            return $id;
        }
    }
>)

    #for($name in (new Algeria)->names)
        (-$name-) <br>
    #endfor

    #for($name => $ndx in (((new Algeria)->names)))
        (-$name-) == (- $ndx -)<br>
    #endfor

    #for($name => $ndx in (((new Algeria)->names)))
        (-$name-) == (- $ndx -)<br>
    #endfor

    #if(count(((new Algeria)->names)) < 3)
        (= "success" =)
    #endif

    #dd("hello")

    #dump("olala")

    (<
        $names = array(
            array("ahmed", "aymen", "rida")
        )
    >)

    #for($name in $names.0)
        (- $name -)
    #endfor

    #for($name in $names.0)
        (- $name -)
    #endfor


    #for($name in $names.0)
        (- $name -)
    #endfor


#endsection



<hr><br><br>

(< $name = "ahmed" >)
(< $aa = array("said")  >)

(- $name -)
(- $name . " hello"  -)
(= $name =)


(= $aa.0 =)
<br>
(< $a = fn($b) => $b >)
(< $d = 10>)

#if (3 > $a($d))
    (= "hello from if" =)
#elif(30 > $a($d))
    azaz
#endif

#if (3 > $a($d))
    (= "hello from if" =)
#elif(30 > $a($d))
    azaz
#endif
#if (3 > $a($d))
    (= "hello from if" =)
#elif(30 > $a($d))
    azaz
#endif
#if (3 > $a($d))
    (= "hello from if" =)
#elif(30 > $a($d))
    azaz
#else
    àààà    
#endif


#if (3 > $a($d))
    (= "hello from if" =)
#else
azeaze
    azaz
#endif


(< $ages = [10, 12, 13, 14] >)

(< $cool = fn() => ["name", "nnn"] >)

#for ($a in $ages)
    (= $a =)
#endfor

#for ($a => $b in $ages)
    (= $a =) => (= $b =)
#endfor

#for ($a => $b in $ages)
    (= $a =) => (= $b =)
#endfor


#for ($i = 0; $i < count((array)$cool()); $i++)
    (= $cool()[$i] =)
#endfor

#for ($i = 0; $i < count((array)$cool()); $i++)
    (= $cool()[$i] =)
#endfor

(<$i = 0>)
#while($i < count($cool()))
    (= $i =) <br>

    (<$i++>)
#endwhile

(<$i = 0>)
#while($i < (3+9))
    (= $i =) <br>
    
    (<$i++>)
#endwhile

(<$i = 0>)
#do
    (= $i =)
    (<$i++>)
#while($i < (20 + 7))
<br>
(<$i = 0>)
#do
    (= $i =)
    #if ($i == 5) #break #endif
    (<$i++>)
#while($i < (20 + 7))