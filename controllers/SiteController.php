<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $sql1 = Yii::$app->db->createCommand('
            select book.name, ct.name as cover_type, book.edition, count(bc.category_id) as category_count
            from book
            inner join cover_type ct on book.cover_type_id = ct.id
            inner join book_category bc on book.id = bc.book_id
            where ct.name = "Твердая" and book.edition = 5000
            group by book.name
            having category_count > 3
        ')->queryAll();

        $sql2 = Yii::$app->db->createCommand('
            select b1.name as book1_name, b2.name as book2_name, count(*) as common_count
            from book_category as bc1
            join book_category as bc2 on bc2.category_id = bc1.category_id and bc2.book_id > bc1.book_id
            join book as b1 on b1.id = bc1.book_id
            join book as b2 ON b2.id = bc2.book_id
            group by bc1.book_id, bc2.book_id
            having common_count >= 3
            order by common_count desc;
        ')->queryAll();

        $sql3 = Yii::$app->db->createCommand('
            select greatest( 
     (select coalesce(max(before_start.mx), 0)
       from (select intervals.datetime, 
                    max(coalesce(incoming.count, 0) - coalesce(outgoing.count, 0)) mx
            from (
                select datetime
                from log
                where datetime < :start
            ) intervals left join (
                select count(*)
 count, datetime
                from log
                  where status = '1'
                group by datetime
            ) incoming on incoming.datetime = intervals.datetime
            left join (
                select count(*)
 count, datetime
                from log
                  where status = '2'
                group by datetime
            ) outgoing on intervals.datetime = outgoing.datetime
            group by intervals.datetime
      ) before_start)
    , (select coalesce(max(from_start_to_end.mx), 0)
       from (select intervals.datetime, 
                    max(coalesce(incoming.count, 0) - coalesce(outgoing.count, 0)) mx
            from (
                select datetime
                from log
                where datetime >= :start
                      and datetime <= :end
            ) intervals left join (
                select count(*)
 count, datetime
                from log
                  where status = '1'
                group by datetime
            ) incoming on incoming.datetime = intervals.datetime
            left join (
                select count(*)
 count, datetime
                from log
                  where status = '2'
                group by datetime
            ) outgoing on intervals.datetime = outgoing.datetime
            group by intervals.datetime
      ) from_start_to_end)
    , (select coalesce(max(after_end.mx), 0)
       from (select intervals.datetime, 
                    max(coalesce(incoming.count, 0) - coalesce(outgoing.count, 0)) mx
            from (
                select datetime
                from log
                where datetime > :end
            ) intervals left join (
                select count(*)
 count, datetime
                from log
                  where status = '1'
                group by datetime
            ) incoming on incoming.datetime = intervals.datetime
            left join (
                select count(*)
 count, datetime
                from log
                  where status = '2'
                group by datetime
            ) outgoing on intervals.datetime = outgoing.datetime
            group by intervals.datetime
      ) after_end)
);
        ')->queryScalar();

        return $this->render('index', [
            'books1' => $sql1,
            'books2' => $sql2,
            'max_count' => $sql3
        ]);
    }
}
