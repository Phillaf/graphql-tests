<?php

namespace App\Schema;

use App\Schema\Mutation;
use App\Schema\Query;
use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Schema\AbstractSchema;

class Schema extends AbstractSchema
{
    public function build(SchemaConfig $config)
    {
        $config->getQuery()->addFields([
            new Query\LatestPost,
        ]);
        $config->getMutation()->addFields([
            new Mutation\LikePost,
            new Mutation\CreatePost,
        ]);
    }
}
