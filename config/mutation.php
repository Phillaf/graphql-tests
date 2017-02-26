<?php

use App\Schema\Type\PostType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Type\Scalar\IntType;

$mutation = new ObjectType([
    'name'   => 'RootMutationType',
    'fields' => [
        // defining likePost mutation field
        'likePost' => [
            // we specify the output type – simple Int, since it doesn't have a structure
            'type'    => new PostType(),
            // we need a post ID and we set it to be required Int
            'args'    => [
                'id' => new NonNullType(new IntType())
            ],
            // simple resolve function that always returns 2
            'resolve' => function () {
                return 2;
            },
        ]
    ]
]);
