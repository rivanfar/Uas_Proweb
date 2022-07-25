<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'team_create',
            ],
            [
                'id'    => 18,
                'title' => 'team_edit',
            ],
            [
                'id'    => 19,
                'title' => 'team_show',
            ],
            [
                'id'    => 20,
                'title' => 'team_delete',
            ],
            [
                'id'    => 21,
                'title' => 'team_access',
            ],
            [
                'id'    => 22,
                'title' => 'master_data_access',
            ],
            [
                'id'    => 23,
                'title' => 'data_satu_create',
            ],
            [
                'id'    => 24,
                'title' => 'data_satu_edit',
            ],
            [
                'id'    => 25,
                'title' => 'data_satu_show',
            ],
            [
                'id'    => 26,
                'title' => 'data_satu_delete',
            ],
            [
                'id'    => 27,
                'title' => 'data_satu_access',
            ],
            [
                'id'    => 28,
                'title' => 'data_dua_create',
            ],
            [
                'id'    => 29,
                'title' => 'data_dua_edit',
            ],
            [
                'id'    => 30,
                'title' => 'data_dua_show',
            ],
            [
                'id'    => 31,
                'title' => 'data_dua_delete',
            ],
            [
                'id'    => 32,
                'title' => 'data_dua_access',
            ],
            [
                'id'    => 33,
                'title' => 'data_tiga_create',
            ],
            [
                'id'    => 34,
                'title' => 'data_tiga_edit',
            ],
            [
                'id'    => 35,
                'title' => 'data_tiga_show',
            ],
            [
                'id'    => 36,
                'title' => 'data_tiga_delete',
            ],
            [
                'id'    => 37,
                'title' => 'data_tiga_access',
            ],
            [
                'id'    => 38,
                'title' => 'data_empat_create',
            ],
            [
                'id'    => 39,
                'title' => 'data_empat_edit',
            ],
            [
                'id'    => 40,
                'title' => 'data_empat_show',
            ],
            [
                'id'    => 41,
                'title' => 'data_empat_delete',
            ],
            [
                'id'    => 42,
                'title' => 'data_empat_access',
            ],
            [
                'id'    => 43,
                'title' => 'proses_data_access',
            ],
            [
                'id'    => 44,
                'title' => 'input_data_create',
            ],
            [
                'id'    => 45,
                'title' => 'input_data_edit',
            ],
            [
                'id'    => 46,
                'title' => 'input_data_show',
            ],
            [
                'id'    => 47,
                'title' => 'input_data_delete',
            ],
            [
                'id'    => 48,
                'title' => 'input_data_access',
            ],
            [
                'id'    => 49,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
