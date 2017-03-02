<?php

namespace App\Schema\Type;

use App\DataProvider;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

class PostType extends AbstractObjectType   // extending abstract Object type
{
    public function build($config)
    {
        $config->addFields([
            'title' => [
                'type' => new StringType(),
                'description' => 'the title of the post',
                'args' => [
                    'truncate' => new BooleanType(),
                ],
            ],
            'title' => new StringType(),
            'status' => new IntType(),
            'summary' => new StringType(),
            'likesCount' => new IntType(),
        ]);
    }

    public function getOne(int $id)
    {
        return DataProvider\Post::getPost($id);
    }
}
