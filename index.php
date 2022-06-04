<?php

require_once __DIR__ . '/models/model.php';
$model = new Model();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
</head>
<body>
    <div>
        <table border="2px" cellpadding="3px" width="500px">
            <caption align="bottom">Производители, с которыми работает магазин</caption>
            <tr>
                <th>№</th>
                <th>Производитель</th>
            </tr>
            <? foreach($model->getVendor() as $index => $vendor) { ?>
            <tr>
                <td align="center"><?= $index ?></td>
                <td><?= $vendor ?></td>
            </tr>
            <? } ?>

        </table>
    </div><br>
    <div>
        <table border="2px" cellpadding="3px" width="1000px">
            <caption align="bottom">Отсутствующие товары</caption>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Производитель</th>
                <th>На складе</th>
                <th>Категория</th>
                <th>Состояние</th>
                <th>Отзывы</th>
            </tr>
            <? foreach($model->getMissingItems() as $index => $item) { ?>
            <tr>
                <td align="center"><?= $index ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['vendor'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= $item['category'] ?></td>
                <td><?= $item['condition'] ?></td>
                <td>
                    <ul>
                    <? foreach(iterator_to_array($item['comments']) as $comment) { ?>
                        <li><?= $comment['name'] ?>: <?= $comment['text'] ?></li>
                    <? } ?>
                    </ul>
                </td>
            </tr>
            <? } ?>

        </table>
    </div><br>
    <div>
        <label for="range">Диапазон цен: </label>
        <input type="text" placeholder="От" id="range-from" list="from-list">
        <datalist id="from-list"></datalist>

        <input type="text" placeholder="До" id="range-to" list="to-list">
        <datalist id="to-list"></datalist>

        <button>Найти</button>
        <ul id="list-range"></ul>
    </div>

    <script src="script.js" defer></script>
</body>
</html>