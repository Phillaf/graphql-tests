<?php

namespace App\DataProvider;

use Cake\ORM\TableRegistry;

class Post
{
    public static function getPost(int $id)
    {
        $posts = TableRegistry::get('Posts');

        $results = $posts->find()->all();

        var_dump($results->toArray());exit;
    }
}
