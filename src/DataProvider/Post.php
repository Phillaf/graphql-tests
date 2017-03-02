<?php

namespace App\DataProvider;

class Post
{
    public static function getPost(int $id)
    {
        return [
            "id"        => "post-" . $id,
            "title"     => "Post " . $id . " title",
            "summary"   => "This new GraphQL library for PHP works really well",
            "status"    => 1,
            "likeCount" => 2
        ];
    }

    public static function getBanner(int $id)
    {
        return [
            'id'        => "banner-" . $id,
            'title'     => "Banner " . $id,
            'imageLink' => "banner" . $id . ".jpg"
        ];
    }
}
