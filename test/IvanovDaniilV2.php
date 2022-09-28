<head><title> Test Case </title></head>
<?php
    echo "Задача: Необходимо найти минимум 3 способа как сложить на PHP 50 цифр по 50 знаков.<br/><br/>";
    $number = 10000000000000000000000000000000000000000000000000; 
    $count = 50; $resultNumber = 0;
    $numbers = array_fill(0, $count, $number); 

    // ========== 1-ЫЙ СПОСОБ ==========
    $strResultNumber = $strSubResultNumber = "";
    for ($i = 0; $i < $count; $i++)
    {       
        $sum = 0; $sumFinal = 0; $inMind = 0;

        if ($i == 0) 
        {
            $maxLength = max(strlen(sprintf('%.0f', $numbers[$i])), strlen(sprintf('%.0f', $numbers[$i])));
            $strNumber1 = str_pad(sprintf('%.0f', $numbers[$i]), $maxLength, '0', 0);
            $strNumber2 = str_pad(sprintf('%.0f', 0), $maxLength, '0', 0);
        }
        else
        {
            $maxLength = max(strlen(sprintf('%.0f', $strResultNumber)), strlen(sprintf('%.0f', $numbers[$i])));
            $strNumber1 = str_pad(sprintf('%.0f', $strResultNumber), $maxLength, '0', 0);
            $strNumber2 = str_pad(sprintf('%.0f', $numbers[$i]), $maxLength, '0', 0);
        }

        for ($j = $maxLength - 1; $j >= 0; $j--) 
        {
            $sum = (int)$strNumber1[$j] + (int)$strNumber2[$j]; 
            $sumFinal = $sum + $inMind; 

            if ($sumFinal > 9) 
            {
                $inMind = 1;
                $sumFinal %= 10;
            }
            else
            {
                $inMind = 0;
            }

            $strSubResultNumber = $sumFinal . $strSubResultNumber; 
        }

        if ($inMind > 0)
        {
            $strSubResultNumber = $inMind . $strSubResultNumber; 
        }

        $strResultNumber = $strSubResultNumber; 
        $strSubResultNumber = "";
    }
    echo "1) $strResultNumber<br/><br/>"; // 1) 499999999999999434544339400785723199804626582896640

    // ========== 2-ОЙ СПОСОБ ==========
    // С помощью функций вычисления чисел с произвольной точностью BC Math
    $number2 = $number / pow(10, 50);
    for ($i = 0; $i < $count; $i++)
    {
        $resultNumber = bcadd($resultNumber, $number2, 50);
    }

    $resultNumber = bcmul($resultNumber, 1000000000000000000);
    $resultNumber = bcmul($resultNumber, 1000000000000000000);
    $resultNumber = bcmul($resultNumber, 100000000000000);

    echo "2.1) $resultNumber<br/>"; // 2.1) 500000000000000000000000000000000000000000000000000
    $resultNumber = 0;

    // Если проделать те же самые действия, но без функций BC Math,
    // то получится совершенно иной вывод, хотя точность вычислений, по сути, нарушена не будет.
    $number2 = $number / pow(10, 50);
    for ($i = 0; $i < $count; $i++)
    {
        $resultNumber += $number2;
    }
    $resultNumber *= 100000000000000000000000000000000000000000000000000;
    echo "2.2) $resultNumber<br/><br/>"; // 2.2) 5.0E+50
    $resultNumber = 0;

    // ========== 3-ИЙ СПОСОБ ==========
    // С помощью GMP чисел и специализированных функций для работы с ними.
    $strNumber = gmp_init("10000000000000000000000000000000000000000000000000");
    for ($i = 0; $i < $count; $i++)
    {
        $resultNumber = gmp_add($resultNumber, $strNumber);
    }

    echo "3) $resultNumber<br/><br/>"; // 3) 500000000000000000000000000000000000000000000000000
?>

