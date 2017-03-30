<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class PostsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Timestamp');
    }
}
