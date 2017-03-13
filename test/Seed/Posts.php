<?php

use Phinx\Seed\AbstractSeed;

class Posts extends AbstractSeed
{
    public function run()
    {
        $data = array(
            array(
                'title' => 'Post 1',
                'body' => 'Content 1',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ),
            array(
                'title' => 'Post 2',
                'body' => 'Content 2',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            )
        );

        $posts = $this->table('posts');
        $posts->insert($data)
              ->save();
    }
}
