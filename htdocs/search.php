<?php

// Проверяем как обратились к этому обработчику если методом POST, то всё нормально, а если нет, то обработчик выполняться не будет!
 if($_SERVER["REQUEST_METHOD"] == "POST")
{

 include("db.php"); // Подключение к БД.

 $search = mysql_real_escape_string($_POST['part_type']); // Принимаем поисковое значение которое нам отправил Ajax и сразу отчищаем его от вредоностного кода который может ввести пользователь.

// Поиск совпадений по поисковому значению. LIKE '%$search%' - Поиск совпадений. LIMIT 5 - Выводить Пять совпадений.
$result = mysqli_query($db,"SELECT * FROM part_types WHERE part_type LIKE '%$search%' LIMIT 5");

 // Проверяем нашлось что или нет.
 If (mysqli_num_rows($result) > 0)
{
$row = mysqli_fetch_array($result);

// Указываем цикл с помощью которого будем выводить все совпадения поиска.
do
{
  // Код пропорционального уменьшения изображения товара  
//$img_path = $row["image"]; // Поле в котором у вас путь и название изображения.
//$max_width = 60; // Максимальный размер изображения. По ширине.
//$max_height = 60; // Максимальный размер изображения. По высоте. 
// list($width, $height) = getimagesize($img_path); 
//$ratioh = $max_height/$height; 
//$ratiow = $max_width/$width; 
//$ratio = min($ratioh, $ratiow); 
// New dimensions 
//$width = intval($ratio*$width); // Ширина которую нужно указать в img.
//$height = intval($ratio*$height); // Высота которую нужно указать в img.

 // Выводим найденые совпадения, которые появятся в выпадающем списке.
echo '

// Выводим в тегах li, так как результат будет выводиться в списке ul.
<li>
// Блок с картинкой.
//<div class="search-result-image" align="center">
// Картинка.Указываем переменную где путь с картинкой и указываем переменные с шириной и высотой.
//<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
</div>
 
// Блок с названием товара и ценой.
<div class="block-title-price">
// Название.
<a href="">'.$row["id"].'</a>
// Цена и Цена в долларах, просто делим цену на доллар. С помощью intval округляем.
<p>'.$row["part_type"].'</p>
 
</div>
 
</li>
';
}
 while ($row = mysqli_fetch_array($result)); // Цикл закончился.
 
// Проверяем если совпадений больше Пяти, то показываем ссылку <strong>Посмотреть все результаты</strong>
if (mysqli_num_rows($result) > 5)
{
    echo '
<center>
<a id="search-more" href="">Посмотреть все результаты →</a>
</center>
';

}

}else{

// Если ничего не найдено, то выводим надпись.
    echo '
<center>
<a id="search-noresult">Ничего не найдено! :\'(</a>
</center>
';
}
 }