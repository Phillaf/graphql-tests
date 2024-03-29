<?php

namespace App\Schema\Type;

use App\DataProvider;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

class PostType extends AbstractObjectType
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
            'body' => new StringType(),
        ]);
    }
}
