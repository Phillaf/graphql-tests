<?php

namespace App\Schema\Mutation;

use App\Schema\Type\PostType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IntType;

class LikePost extends AbstractField
{
    public function getName()
    {
        return 'likePost';
    }

    public function build(FieldConfig $config)
    {
        $config->addArgument('id', new NonNullType(new IntType()));
    }

    public function getType()
    {
        return new IntType();
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        return 2;
    }
}
