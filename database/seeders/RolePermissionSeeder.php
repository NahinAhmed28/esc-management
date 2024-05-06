<?php
namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Permission::truncate();
        
        DB::table('roles_permissions')->truncate();
        DB::table('permissions')->truncate();
        // Permission List as array
        $permissions = [

           [
                'group_parent_name' => 'role-permissions',
                'group_name' => 'role',
                'permissions' => [
                    'role.create',
                    'role.read',
                    'role.update',
                    'role.delete',
                    'role.permission.update',
                ]
            ],
            
            [
                'group_parent_name' => 'role-permissions',
                'group_name' => 'user_type',
                'permissions' => [
                    'user_type.create',
                    'user_type.read',
                    'user_type.update',
                    'user_type.delete'
                ]
            ],
            [
                'group_parent_name' => 'role-permissions',
                'group_name' => 'site_setting',
                'permissions' => [
                    'site_setting.create',
                    'site_setting.read',
                    'site_setting.update',
                    'site_setting.delete'
                ]
            ],

            // [
            //     'group_parent_name' => 'role-permissions',
            //     'group_name' => 'lang',
            //     'permissions' => [
            //         'lang.create',
            //         'lang.read',
            //         'lang.update',
            //         'lang.delete'
            //     ]
            // ],


            // [
            //     'group_parent_name' => 'administrative_locations',
            //     'group_name' => 'division',
            //     'permissions' => [
            //         'division.create',
            //         'division.read',
            //         'division.update',
            //         'division.delete'
            //     ]
            // ],


            // [
            //     'group_parent_name' => 'administrative_locations',
            //     'group_name' => 'district',
            //     'permissions' => [
            //         'district.create',
            //         'district.read',
            //         'district.update',
            //         'district.delete'
            //     ]
            // ],

            // [
            //     'group_parent_name' => 'administrative_locations',
            //     'group_name' => 'upazila',
            //     'permissions' => [
            //         'upazila.create',
            //         'upazila.read',
            //         'upazila.update',
            //         'upazila.delete'
            //     ]
            // ],

            // [
            //     'group_parent_name' => 'administrative_locations',
            //     'group_name' => 'thana',
            //     'permissions' => [
            //         'thana.create',
            //         'thana.read',
            //         'thana.update',
            //         'thana.delete'
            //     ]
            // ],

            // [
            //     'group_parent_name' => 'locations',
            //     'group_name' => 'association',
            //     'permissions' => [
            //         'association.create',
            //         'association.read',
            //         'association.update',
            //         'association.delete'
            //     ]
            // ],

            [
                'group_parent_name' => 'locations',
                'group_name' => 'area',
                'permissions' => [
                    'area.create',
                    'area.read',
                    'area.update',
                    'area.delete'
                ]
            ],

            [
                'group_parent_name' => 'locations',
                'group_name' => 'branch',
                'permissions' => [
                    'branch.create',
                    'branch.read',
                    'branch.update',
                    'branch.delete'
                ]
            ],

            // [
            //     'group_parent_name' => 'locations',
            //     'group_name' => 'branch_unit',
            //     'permissions' => [
            //         'branch_unit.create',
            //         'branch_unit.read',
            //         'branch_unit.update',
            //         'branch_unit.delete'
            //     ]
            // ],


            // [
            //     'group_parent_name' => 'users',
            //     'group_name' => 'user',
            //     'permissions' => [
            //         'user.create',
            //         'user.read',
            //         'user.view',
            //         'user.print',
            //         'user.search',
            //         'user.update',
            //         'user.delete'
            //     ]
            // ],
           
            [
                'group_parent_name' => 'users',
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.read',
                    'admin.update',
                    'admin.delete',
                    'admin.change.password',
                ]
            ],
           
            [
                'group_parent_name' => 'users',
                'group_name' => 'branch_user',
                'permissions' => [
                    'branch_user.create',
                    'branch_user.read',
                    'branch_user.update',
                    'branch_user.delete',
                    'branch_user.change.password',
                ]
            ],

            [
                'group_parent_name' => 'master',
                'group_name' => 'office_type',
                'permissions' => [
                    'office_type.create',
                    'office_type.read',
                    'office_type.update',
                    'office_type.delete',
                ]
            ],

            [
                'group_parent_name' => 'master',
                'group_name' => 'service_type',
                'permissions' => [
                    'service_type.create',
                    'service_type.read',
                    'service_type.update',
                    'service_type.delete',
                ]
            ],

            [
                'group_parent_name' => 'master',
                'group_name' => 'service',
                'permissions' => [
                    'service.create',
                    'service.read',
                    'service.update',
                    'service.delete',
                ]
            ],

            [
                'group_parent_name' => 'master',
                'group_name' => 'approval',
                'permissions' => [
                    'approval.create',
                    'approval.read',
                    'approval.update',
                    'approval.delete',
                ]
            ],

            [
                'group_parent_name' => 'applications',
                'group_name' => 'application',
                'permissions' => [
                    'application.create',
                    'application.read',
                    'application.update',
                    'application.update_approval',
                    'application.delete',
                ]
            ],

            [
                'group_parent_name' => 'applications',
                'group_name' => 'applicationdeclined',
                'permissions' => [
                    'applicationdeclined.create',
                    'applicationdeclined.read',
                    'applicationdeclined.update',
                    'applicationdeclined.update_approval',
                    'applicationdeclined.delete',
                ]
            ],

            [
                'group_parent_name' => 'applications',
                'group_name' => 'applicationreview',
                'permissions' => [
                    'applicationreview.create',
                    'applicationreview.read',
                    'applicationreview.update',
                    'applicationreview.update_approval',
                    'applicationreview.delete',
                ]
            ],

            [
                'group_parent_name' => 'applications',
                'group_name' => 'applicationcomplete',
                'permissions' => [
                    'applicationcomplete.create',
                    'applicationcomplete.read',
                    'applicationcomplete.update',
                    'applicationcomplete.update_approval',
                    'applicationcomplete.delete',
                ]
            ]

        ];


        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionParentGroup = $permissions[$i]['group_parent_name'];
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $count = Permission::where(['name'=>$permissions[$i]['permissions'][$j]])->count();
                if ($count < 1) {
                    $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_parent_name' => $permissionParentGroup, 'group_name' => $permissionGroup, 'guard_name'=>'admin']);
                }
            }
        }
        
        $permissions = Permission::get();

        foreach (Admin::DEFAULT_ROLE as $key1 => $item) {
            foreach ($permissions as $key => $value) {
                DB::insert("INSERT INTO `roles_permissions` (`role_id`,`permission_id`) VALUES ($key1, $value->id)");
            }
        }

        // foreach ($permissions as $key => $value) {
        //     DB::insert("INSERT INTO `roles_permissions` (`role_id`,`permission_id`) VALUES (1, $value->id)");
        // }
        
        // foreach ($permissions as $key => $value) {
        //     DB::insert("INSERT INTO `roles_permissions` (`role_id`,`permission_id`) VALUES (2, $value->id)");
        // }
        
        // foreach ($permissions as $key => $value) {
        //     DB::insert("INSERT INTO `roles_permissions` (`role_id`,`permission_id`) VALUES (3, $value->id)");
        // }



        // foreach ($permissions as $key => $value) {
        //     DB::insert("INSERT INTO `roles_permissions` (`role_id`,`permission_id`) VALUES (5, $value->id)");
        // }

        
        // foreach ($permissions as $key => $value) {
        //     DB::insert("INSERT INTO `roles_permissions` (`role_id`,`permission_id`) VALUES (9, $value->id)");
        // }
        // foreach ($permissions as $key => $value) {
        //     DB::insert("INSERT INTO `roles_permissions` (`role_id`,`permission_id`) VALUES (10, $value->id)");
        // }
    }
}

