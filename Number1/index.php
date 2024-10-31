<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Задание №1 "Статьи на сайте"</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    
    <style>
        .your-class {width: 70%;margin: auto;}
        .slick-slide {margin: 0 10px;padding: 1%;background: rgba(155, 224, 255, 0.7);text-align: center;height: auto;font-size: 20px;border-radius: 20px;}
    </style>
</head>
<body style="background-image:url('./img/9590073.jpg'); padding-top: 10%;">

<div class="your-class">
    <?php
    include 'Data.php';
    for ($i=0; $i < count($data); $i++) { 
        echo "<div>" . generateAnnouncement($data[$i], $url[$i], $img[$i]) . "</div>";
    }
    ?>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.your-class').slick({
            slidesToShow: 2,
            slidesToScroll: 1
        });
    });
</script>

<?php
// header('Content-Type: text/html; charset=utf-8');
function generateAnnouncement($text, $url, $img) {
    $maxLength = 250; // Максимальная длина текста
    // Если текст длиннее $maxLength, он обрезается до $maxLength
    if (strlen($text) > $maxLength) { 
        $text = substr($text, 0, $maxLength);
        // Ищем последний пробел, чтобы не обрезать текст посреди слова
        $lastSpace = strrpos($text, ' ');
        if ($lastSpace !== false) {
            $text = substr($text, 0, $lastSpace);
        }
    }
    // Разбиваем текст на отдельные слова
    $words = explode(' ', $text);
    $wordCount = count($words);
    // Ищем последние три слова текста
    $lastThreeWords = implode(' ', array_slice($words, -3));
    // Ищем текст до последних трех слов
    $mainText = implode(' ', array_slice($words, 0, $wordCount - 3));
    $announcement = $mainText . ' <a href="' . htmlspecialchars($url) . '">' . $lastThreeWords . '...' . '</a> <img style = "width: 70%; margin: 10px auto 20px; display: block; border-radius: 20px; margin-top: 5%;" src ="' . $img . '">';
    return $announcement;
}
?>
</body>
</html>