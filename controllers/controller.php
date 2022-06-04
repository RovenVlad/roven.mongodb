<?php

require_once($_SERVER['DOCUMENT_ROOT'] .'/models/model.php');

$model = new Model();
$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_POST['event']) {
    case 'range': 
        $res = '';
        foreach ($model->getRange($_POST['from'], $_POST['to']) as $value) {
            $res .= "<li>" . $value['name'] . "; Цена: " . $value['price'] . "; Кол-во: " . $value['quantity'] . "; Производитель: " . $value['vendor'] . "; Категория: " . $value['category'] . "; Состояние: " . $value['condition'] . "</li>";
        }
        echo json_encode($res);
        break;
}
