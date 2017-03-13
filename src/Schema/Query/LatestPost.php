<?php

namespace App\Schema\Query;

use App\DataProvider;
use App\Schema\Type\PostType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Cake\ORM\TableRegistry;

class LatestPost extends AbstractField
{
    public function getName()
    {
        return 'latestPost';
    }

    public function getType()
    {
        return new PostType();
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        $posts = TableRegistry::get('Posts');
        $results = $posts->find()->all();
        return $results->toArray();
    }
}
