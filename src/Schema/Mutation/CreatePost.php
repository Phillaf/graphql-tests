<?php

namespace App\Schema\Mutation;

use App\Schema\Type\PostInputType;
use App\Schema\Type\PostType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Type\Scalar\StringType;

class CreatePost extends AbstractField
{
    public function getName()
    {
        return 'createPost';
    }

    public function getType()
    {
        return new PostType();
    }

    public function build(FieldConfig $config)
    {
        $config
            ->addArgument('author', new StringType())
            ->addArgument('post', new PostInputType());
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        var_dump($info);exit;
        $posts = TableRegistry::get('Posts');
        $results = $posts->find()->first();
        return $results->toArray();

        return [
            'title' => 'hi',
            'body' => 'dude',
        ];
    }
}
