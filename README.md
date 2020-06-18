<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

1. Спроектировать БД для хранения книг и категорий, к которым эти книги относятся. Одна книга может относится к нескольким категориям. У сущности книг, помимо названия, есть свойства: тираж и тип обложки (мягкая, твёрдая). Планируется, что БД будет содержать информацию о большом количестве книг.
SQL 1: Вернуть книги, выпущенные в твёрдой обложке, тиражом 5000 экз., которые относятся больше чем к трём категориям
SQL 2: Вернуть пары "книга — книга" и количество общих категорий для этих двух книг, если количество общих категорий больше или равно 10.

2. Имеется модуль, который логирует факт посещения сёрфером сайта (несколько миллионов посещений в день). Лог ведётся в таблицу БД. Структура таблицы: (datetime (присутствует индекс), status) Пишется дата+время и статус (1 — пришли на сайт, 2 — ушли). Реализовать возможность определения максимального количество сёрферов, одновременно находящихся на сайте за определённый промежуток времени (максимальный диапазон - один день, минимальный - одна секунда). Для удобства можно использовать любой фреймворк. Входные данные - две даты (границы диапазона), выходные - число. Ограничения: нельзя использовать триггеры и хранимые процедуры
