<?php

// Описание функции Web-сервиса сама служба, склад
// Клиент запрашивает полку ему вернется кол-ко товара
// Веб служба - нужно протестировать этот код
// Придет запрос и разберется сам, от нас все будет скрыто
function getStock($id) {
    // склад
    $stock = [
        "1" => 100,
        "2" => 200,
        "3" => 300,
        "4" => 400,
        "5" => 500
    ];
    if (isset($stock[$id])) {
        $quantity = $stock[$id];
        return $quantity;
    } else {
        throw new SoapFault("Server", "Несуществующий id товара");
    }
}

// Отключение кэширования WSDL-документа
ini_set("soap.wsdl_cache_enabled", "0");
// Создание SOAP-сервер
$server = new SoapServer("http://127.0.0.1/stock.wsdl");
// Добавить класс к серверу
$server->addFunction("getStock"); // можно указать несколько функций
// Запуск сервера
$server->handle();

?>