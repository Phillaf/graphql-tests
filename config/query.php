<?php

use App\Schema\Query\LatestPost;
use App\Schema\Mutation\LikePost;
use Youshido\GraphQL\Type\Object\ObjectType;

$query = new ObjectType([
    'name' => 'RootQueryType',
    'fields' => [
        new LatestPost,
        new LikePost,
    ],
]);
