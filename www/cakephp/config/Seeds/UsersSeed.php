<?php
declare(strict_types=1);

use Cake\Datasource\ConnectionManager;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'user1',
            ],
        ];

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $usersTable->getConnection()->transactional(function () use ($usersTable, $data) {
            $users = $usersTable->find()->all();
            $entities = $usersTable->patchEntities($users, $data);
            $usersTable->saveManyOrFail($entities);
        });
    }
}
