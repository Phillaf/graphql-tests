<?php

use Phinx\Migration\AbstractMigration;

class InitialSchema extends AbstractMigration
{
    public function change()
    {
        $this->table('posts')
            ->addColumn('title', 'string')
            ->addColumn('body', 'text')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
