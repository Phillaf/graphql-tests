<?php

namespace App\Schema\Type;

use App\DataProvider;
use Youshido\GraphQL\Type\InputObject\AbstractInputObjectType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;

class PostInputType extends AbstractInputObjectType
{
    public function build($config)
    {
        $config->addFields([
            'title' => new NonNullType(new StringType()),
            'body' => new StringType(),
        ]);
    }
}
