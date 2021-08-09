<?php

    $num1 = 18;
    $num2 = 6;
    $operator = "*";

    echo "num1 is equal to : " . $num1 . "<br>";
    echo "num2 is equal to : " . $num2 . "<br>";

    switch($operator)
    {
        case "+":
            echo "num1 + num2 = " . $num1+$num2;
            break;

        case "-":
            echo "num1 - num2 = " . $num1-$num2;
            break;

        case "*":
            echo "num1 * num2 = " . $num1*$num2;
            break;

        case "/":
            echo "num1 / num2 = " . $num1/$num2;
            break;
}



?>