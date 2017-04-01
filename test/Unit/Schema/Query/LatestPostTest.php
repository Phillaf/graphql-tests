<?php

namespace App\Test\Unit\Schema\Query;

use App\Test\AssertResponse;
use App\Test\Database;
use PHPUnit\Framework\TestCase;

class LatestPostTest extends TestCase
{
    use AssertResponse;

    private $request = '{ latestPost {title, body} }';
    private $response = [
        "data" => [
            "latestPost" => [
                "title" => "Post 1",
                "body" => "Content 1",
            ]
        ]
    ];

    public function setUp()
    {
        Database::seed(['Posts']);
    }

    public function tearDown()
    {
        Database::truncate(['Posts']);
    }
}
