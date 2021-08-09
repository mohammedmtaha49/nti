<?php

    function elctricity_bill($kilos)
    {
        if ($kilos <= 50)
        {
            $price = $kilos * 3.50;
        }
        elseif ($kilos > 50 && $kilos <= 150)
        {
            $price = $kilos * 4.00;
        }
        else
        {
            $price = $kilos * 6.50;
        }

        return "number of kilos is : " . $kilos . " and the price is : " . $price . " ." ;
    }


   echo elctricity_bill(40) . "<br>" . "<br>";
   echo elctricity_bill(50) . "<br>" . "<br>";
   echo elctricity_bill(51) . "<br>" . "<br>";
   echo elctricity_bill(110) . "<br>" . "<br>";
   echo elctricity_bill(150) . "<br>" . "<br>";
   echo elctricity_bill(151) . "<br>" . "<br>";
   echo elctricity_bill(200) . "<br>" . "<br>";


?>