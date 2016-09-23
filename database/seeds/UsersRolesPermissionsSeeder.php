<?php

use Illuminate\Database\Seeder;

class UsersRolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$user = factory(\App\Models\User::class)->create([
            'name' => 'Admin da Silva',
            'email' => 'admin@admin.com',
            'password' => bcrypt(123456)
        ]);*/

        $roleAdmin = factory(App\Models\Role::class)->create([
            'name' => 'Admin',
            'description' => 'Administrador do sistema'
        ]);

        $roleCoordinator = factory(App\Models\Role::class)->create([
            'name' => 'Coordenador',
            'description' => 'Coordenador'
        ]);

        $roleServer = factory(App\Models\Role::class)->create([
            'name' => 'Servidor',
            'description' => 'Servidor'
        ]);

        $userList = factory(App\Models\Permission::class)->create([
            'name'=>'user_list',
            'description' => 'Can list all users'
        ]);

        $userViewRoles = factory(App\Models\Permission::class)->create([
            'name'=>'user_view_roles',
            'description' => 'Can view the users roles'
        ]);

        $userAddRole = factory(App\Models\Permission::class)->create([
            'name'=>'user_add_role',
            'description' => 'Can add a new role for an user'
        ]);

        $userRevokeRole = factory(App\Models\Permission::class)->create([
            'name'=>'user_revoke_role',
            'description' => 'Can revoke a role for an user'
        ]);

        $ServerRoles = factory(App\Models\Permission::class)->create([
            'name'=>'permission_server',
            'description' => 'Can register photo'
        ]);

        $AdminRoles = factory(App\Models\Permission::class)->create([
            'name'=>'role_admin',
            'description' => 'Can admin all roles'
        ]);

        $roleCoordinator->addPermission($userList);
        $roleCoordinator->addPermission($userViewRoles);

        $roleServer->addPermission($ServerRoles);
    }
}
