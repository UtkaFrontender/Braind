<?php
list($width, $height) = explode(' ', trim(fgets(STDIN)));
if($width >= 32 && $width <= 2000 && $height >= 32 && $height <= 2000) {
    $image = [];
    $newImage = [];
    $newImage_2 = [];

    for ($i = 0; $i < $height; $i++) {
        $line = trim(fgets(STDIN)); // Читаем введенную строку
        if (strlen($line) == $width * 2 - 1 && preg_match('/^[01 ]+$/', $line)) {
            // Если строка соответствует условиям, добавляем в массив
            $image[] = $line;
        } else {
            echo "Введенная строка либо длинне, чем вы задали, либо содержит символы отличные от 1, 0 и пробела. \n";
            // Если строка не подходит, просим ввести снова
            $i--;
        }
    }

    foreach ($image as $row) {
        $newImage[] = str_replace(" ", "", $row);
    }


    //Проверка на наличие рамки: если рамка состоит только из 0 - функция возвращает True
    function Borders($newImage) {
        $height = count($newImage);
        $width = strlen($newImage[0]);
        if (strpos($newImage[0], '1') !== false || strpos($newImage[$height - 1], '1') !== false) {
            return false;
        }
        for ($i = 1; $i < $height - 1; $i++) {
            if ($newImage[$i][0] !== '0' || $newImage[$i][$width - 1] !== '0') {
                return false;
            }
        }
        return true;
    }

    if (Borders($newImage)){
        foreach ($newImage as $row) {
            $newRow = str_replace("0", "", $row);
            if ($newRow !== "") {
                $newImage_2[] = $newRow;
            }
        }

        function isSquare($newImage_2)
        {
            $rowCount = count($newImage_2);
            $countOnes = strlen($newImage_2[0]);
            // Если количество единиц в строке (т.е. количество столбцов в фигуре)
            //не равно количеству строк в массиве (в фигуре строк) - это не квадрат
            if ($countOnes != $rowCount) {
                return false;
            }
            // Проверяем количество единиц в каждой строке
            foreach ($newImage_2 as $row) {
                if (strlen($row) != $countOnes) {
                    return false; // Если отличается, то не квадрат
                }
            }
            return true;
        }

        function isTriangle($newImage_2)
        {
            for ($i = 0; $i < count($newImage_2) - 1; $i++) {
                if (abs(strlen($newImage_2[$i]) - strlen($newImage_2[$i + 1])) <= 2) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        if (!empty($newImage_2) && isSquare($newImage_2)) {
            echo "Square\n";
        } elseif (!empty($newImage_2) && isTriangle($newImage_2)) {
            echo "Triangle\n";
        } else {
            echo "Circle\n";
        }
    }
    else{
        echo 'Ваша рамка не состоит из 0!';
        return;
    }
}
else{
    echo 'Вы ввели значения не подходящие под условия!';
    return;
}