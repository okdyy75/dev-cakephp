<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use App\Model\Table\UsersTable;
use App\Test\Factory\UserFactory;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use CakephpTestSuiteLight\Fixture\TruncateDirtyTables;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;
    use TruncateDirtyTables;

    private UsersTable $Users;

    public function setUp(): void
    {
        parent::setUp();
        $this->Users = $this->getTableLocator()->get('Users');
        $this->enableCsrfToken();
    }

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\UsersController::index()
     */
    public function testIndex(): void
    {
        $expectedCount = 5;
        $user = UserFactory::make([], $expectedCount)->persist();
        $this->get('/users');
        $this->assertResponseOk();
        $users = $this->viewVariable('users');
        $this->assertCount($expectedCount, $user);
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\UsersController::view()
     */
    public function testView(): void
    {
        $userName = 'テストユーザー';
        $user = UserFactory::make(['name' => $userName])->persist();
        $this->get('/users/view/' . $user->id);
        $this->assertResponseOk();
        $user =  $this->viewVariable('user');
        $this->assertEquals($userName, $user->name);
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\UsersController::add()
     */
    public function testAdd(): void
    {
        $userName = 'テストユーザー';
        $data = [
            'name' => $userName
        ];
        $this->enableCsrfToken();
        $this->post('/users/add', $data);
        $this->assertRedirect('/users');
        $existsAddUser = $this->Users->exists([
            'name' => $userName
        ]);
        $this->assertTrue($existsAddUser);
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\UsersController::edit()
     */
    public function testEdit(): void
    {
        $userName = 'テストユーザー';
        $user = UserFactory::make()->persist();
        $data = [
            'name' => $userName
        ];
        $this->patch('/users/edit/' . $user->id, $data);
        $this->assertRedirect('/users');
        $editUser = $this->Users->get($user->id);
        $this->assertEquals($userName, $editUser->name);
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\UsersController::delete()
     */
    public function testDelete(): void
    {
        $user = UserFactory::make([])->persist();
        $this->delete('/users/delete/'. $user->id);
        $this->assertRedirect('/users');
        $exitsDeleteUser = $this->Users->exists(['id' => $user->id]);
        $this->assertFalse($exitsDeleteUser);
    }
}
