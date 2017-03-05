<?php

namespace App\Schema;

use App\Schema\Mutation\LikePost;
use App\Schema\Query\LatestPost;
use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Schema\AbstractSchema;

class Schema extends AbstractSchema
{
    public function build(SchemaConfig $config)
    {
        $config->getQuery()->addFields([
            new LatestPost,
        ]);
        $config->getMutation()->addFields([
            new LikePost,
        ]);
    }
}
