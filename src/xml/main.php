<?php

// DOM SimpleXML-Sax XMLReader XMLWriter

// SAX - самый простой парсинг xml - поточный, не проверяет документ на валидность, он просто тупо ищет теги
// используется редко
// создание парсера
$sax = xml_parser_create("utf-8");

// обработчик начальных тегов
function onStart($parser, $tag, $attributes){
    //echo $tag."\n";
}

// обработчик текста
function onText($parser, $text){
    //echo $text."\n";
}

// обработчик закрывающих тегов
function onEnd($parser, $tag){
    //echo $tag."\n";
}

// Назначим обработчики
xml_set_element_handler($sax, "onStart", "onEnd");
xml_set_character_data_handler($sax, "onText");


xml_parse($sax, file_get_contents('catalog.xml'));

// ----------------------------------------------

// DOM - для создания и чтения

$dom = new DOMDocument();

// зачитаем документ и развернем в дерево
$dom->load('catalog.xml');

// корневой элемент
$root = $dom->documentElement;
$root->nodeType; // тип
$root->textContent; // весь текст на любом уровне вложенности
$books = $root->childNodes; // дети элемента

// вывести все книги
foreach ($books as $k => $v){
    //($v->nodeType == 1) ? var_dump($v->textContent. "\n") : false; // конкретная книга
}

// и так далее по аналогии с JS все универсально, так же читает html

// Создание xml

$d = new DOMDocument("1.0", "utf-8");

$root = $dom->documentElement;

$book = $d->createElement("book");
$title = $d->createElement("title");
$text = $d->createTextNode('text');

// вложение элементов
$title->appendChild($text);
$book->appendChild($title);
//$root->appendChild($book);


// Simple Xml - для быстрого чтения

$sxml = simplexml_load_file("catalog.xml");
//$sxmls = simplexml_load_string("XML строка"); // корневой элемент
$sxml->book[1]->title; // элемент
$sxml->book[2];

// XMLReader XMLWriter - читалка и писалка но используется не часто