<?php

// работа с файлами и директориями

file_exists('text.txt');  // существует ли фаил или директория
is_file('file.txt');     // существует ли фаил
is_dir('dir');          // существует ли директория
//filesize('file.txt'); // размер файла в байтах
//filemtime('file.txt'); // время последнего измения файла

// проверки что можно с файлом делать, функции общего назначения
is_executable('file'); // является ли файл исполняемым
is_readable('file'); // доступен ли фаил для чтения
is_writable('file'); // доступен ли фаил для записи
is_uploaded_file('file'); // определяет был ли фаил загржен через POST


// открытие потока на чтение
/*
  r -  для чтения указатель в начало
  r+ - для чтения и записи указатель в начало

  w - для записи, указатель в начало, если файла нет то создает его
  w - для чтения и записи, указатель в начало, если файла нет то создает его

  a - для записи курсор в конец
  a+ - для записи и чтения курсор в конец

*/
$file = fopen(__DIR__ . '/text.txt', 'a+'); // дескриптор файла или ресурс
// что то делаем с файлами
//var_dump(fread($file, 5)); // читаем первые 5 байт - 5 символов
//var_dump(fread($file, 3)); // следующие 3 символа 1 символ - 1 байт
//fpassthru($file); // зачитать весь файл с указанного указателя

// записываем файл в массив
$arr = file(__DIR__ . '/text.txt');
// можно чистать построчно, побайтово


// выведем массив построчно в консоль, последняя строка колличество строк

$iterArr = function ($a) {
    $iter = function ($acc, $max) use (&$iter, $a) {
        if ($acc == $max) {
            return $acc;
        }
        var_dump($a[$acc]);
        return $iter($acc + 1, $max);
    };

    return $iter(0, count($a));
};

//var_dump($iterArr($arr));
/*$bytes = function ($file){
    $iter = function ($acc,$result) use(&$iter,$file){
        if(!feof($file)){
            $result[] = fgetc($file);
        }

        return $iter($acc + 1);
    };

    return $iter(0,[]);
};*/

// пишем в фаил
//fputs($file, PHP_EOL."seven"); // в конец при условии a+

// переместить курсор
/*fseek();
ftell();
fread();
rewind();*/

fclose($file); // закрытие фаил

// но если не нужно работать подробно то достаточно следующего:

//readfile('text.txt'); // напрямую вывести фаил в поток
file_get_contents('text.txt'); // получить фаил в виде строки

// записать в фаил не затирая содержимое
// в большинстве случаев этого достаточно
//file_put_contents('text.txt', PHP_EOL . "eith", FILE_APPEND);
//var_dump($file);

//copy(); // копировать
//rename(); // переименовать
//unlink(); // удалить

//mkdir() создать директорию
//rmdir() удалить директорию ! но только пустая
getcwd(); // имя текушей директории
$resourceDir = opendir('.'); // дескриптор директории можно вывести все файлы

// читаем из csv в массив
$h = fopen(__DIR__ . '/import.csv', 'r');
$af = file(__DIR__ . '/import.csv');

$newArr = range(0, count($af)); // массив из элементов сколько строк в файле

// кол-во строк в файле
function countStr($file)
{
    return count(file(__DIR__ . '/' . $file));
}

// делаем массив из файла
function makeArray($fileName)
{
    $f = fopen(__DIR__ . '/' . $fileName, 'r');
    $result = array_map(function ($e) use ($f) {
        return fgetcsv($f, 1000, ",");
    }, range(0, countStr($fileName)));

    //array_shift($result);
    array_pop($result);
    return $result;
}



/*$result = [];
while ($data = fgetcsv($h, 1000, ",")) {
 $result[] = $data;
}*/

//array_shift($result);
//var_dump($result);

array_walk_recursive(makeArray('import.csv'), function ($e, $k) {
    echo '[' . $k . '=>' . $e . ']' . "\n";
    if ($k == 4) {
        echo "\n";
    }

});
//var_dump(makeArray('import.csv'));

//print_r($result);
