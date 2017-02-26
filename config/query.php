<?php

use App\Schema\Field\LatestPostField;
use Youshido\GraphQL\Type\Object\ObjectType;

$query = new ObjectType([
    'name' => 'RootQueryType',
    'fields' => [
        new LatestPostField,
    ],
]);
