<?php
declare(strict_types=1);

use App\Test\Factory\UserFactory;
use Cake\ORM\TableRegistry;
use Migrations\AbstractSeed;

/**
 * UsersSample seed.
 */
class UsersSampleSeed extends AbstractSeed
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
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'name' => $faker->lastName(),
            ];
        }

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $usersTable->getConnection()->transactional(function () use ($usersTable, $data) {
            $entities = $usersTable->newEntities($data);
            $usersTable->saveManyOrFail($entities);
        });
    }
}
