<?php

/* @var $this yii\web\View */
/* @var $books1 array */
/* @var $books2 array */
/* @var $max_count string */

$this->title = 'Тестовое задание';
?>
<div class="site-index">

    <p>Вернуть книги, выпущенные в твёрдой обложке, тиражом 5000 экз., которые относятся больше чем к трём категориям:</p>

    <?php if (count($books1) > 0) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Название</td>
                    <td>Тип обложки</td>
                    <td>Тираж</td>
                    <td>Кол-во категорий</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($books1 as $book) : ?>
                <tr>
                    <td><?=$book['name']?></td>
                    <td><?=$book['cover_type']?></td>
                    <td><?=$book['edition']?></td>
                    <td><?=$book['category_count']?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        Книги не найдены...
    <?php endif; ?>

    <p>Вернуть пары "книга — книга" и количество общих категорий для этих двух книг, если количество общих категорий больше или равно 3:</p>

    <?php if (count($books2) > 0) : ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>Название книги 1</td>
                <td>Название книги 2</td>
                <td>Кол-во общих категорий</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books2 as $book) : ?>
                <tr>
                    <td><?=$book['book1_name']?></td>
                    <td><?=$book['book2_name']?></td>
                    <td><?=$book['common_count']?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        Книги не найдены...
    <?php endif; ?>

    <p>Имеется модуль, который логирует факт посещения сёрфером сайта (несколько миллионов посещений в день). Лог ведётся в таблицу БД. Структура таблицы: (id. datetime, status) Пишется время и статус (1 — пришли на сайт, 2 — ушли). Реализовать возможность определения максимального количество сёрферов, одновременно находящихся на сайте за определённый промежуток времени (максимальный диапазон - один день, минимальный - одна минута). </p>
    <p>Максимальное кол-во одновременных серферов за 2019-08-09: <b><?=$max_count?></b></p>
</div>
