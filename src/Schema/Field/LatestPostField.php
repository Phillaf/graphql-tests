<?php

namespace App\Schema\Field;

use App\Schema\Type\PostType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;

class LatestPostField extends AbstractField
{
    public function getType()
    {
        return new PostType();
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        return [
            "title"   => "New approach in API has been revealed",
            "summary" => "In two words - GraphQL Rocks!",
            "likesCount" => 2,
        ];
    }
}
