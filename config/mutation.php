<?php

use App\Schema\Mutation\LikePost;
use App\Schema\Type\PostType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Type\Scalar\IntType;

$mutation = new ObjectType([
    'name'   => 'RootMutationType',
    'fields' => [
        new LikePost,
    ]
]);
