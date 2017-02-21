<?php
try {
    // Создание SOAP-клиента
    $client = new SoapClient("http://127.0.0.1/stock.wsdl");

    // Посылка SOAP-запроса c получением результат
    $result = $client->getStock("7");
    echo "Текущий запас на складе: ", $result;
} catch (SoapFault $exception) {
    echo $exception->getMessage();
}
?>