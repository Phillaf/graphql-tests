<?php

namespace App\Test\Unit\Schema\Mutation;

use App\Test\AssertResponse;
use App\Test\Database;
use PHPUnit\Framework\TestCase;

class CreatePostTest extends TestCase
{
    use AssertResponse;

    private $request = <<<QUERY
mutation {
    createPost(
        author: "phillaf",
        post: {
            title: "hi",
            body: "dude"
        }
    )
    {
        title,
        body
    }
}
QUERY;

    private $response = [
        "data" => [
            "createPost" => [
                "title" => "hi",
                "body" => "dude",
            ]
        ]
    ];


    public function tearDown()
    {
        Database::truncate(['Posts']);
    }
}
