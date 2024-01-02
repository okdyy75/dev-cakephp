<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    protected $Users;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = $this->getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Users);

        parent::tearDown();
    }

     /**
      * Test validationDefault method
      *
      * @dataProvider validationDefaultDataProvider
      * @param   array  $params
      * @param   bool   $hasError
      * @param   array  $errors
      * @return void
      * @uses \App\Model\Table\UsersTable::validationDefault()
      */
    public function testValidationDefault(array $params, bool $hasError, array $errors): void
    {
        $entity = $this->Users->newEntity($params);
        $this->assertEquals($hasError, $entity->hasErrors());
        $this->assertEquals($errors['name'], $entity->getError('name'));
    }

    /**
     * @dataProvider validationDefaultDataProvider
     *
     * @return array
     */
    public function validationDefaultDataProvider(): array
    {
        return [
            'success' => [
                ['name' => 'ユーザー名'],
                false,
                ['name' => []],
            ],
            '最大文字数を超える' => [
                ['name' => str_repeat('a', 256)],
                true,
                ['name' => [
                    'maxLength' => '最大文字数は255文字です'
                ]]
            ],
            'フィールドが存在しない' => [
                [],
                true,
                ['name' => [
                    '_required' => 'このフィールドは必須です'
                ]]
            ],
            '空文字が入る' => [
                ['name' => ''],
                true,
                ['name' => [
                    '_empty' => 'このフィールドを空にすることはできません'
                ]]
            ],
        ];
    }
}
