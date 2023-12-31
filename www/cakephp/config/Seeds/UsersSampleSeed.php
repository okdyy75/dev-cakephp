<?php
declare(strict_types=1);

use App\Test\Factory\UserFactory;
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
        UserFactory::make([], 100)->persist();
    }
}
