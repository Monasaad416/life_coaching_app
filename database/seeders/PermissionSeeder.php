<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Permissionseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'create_client', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'edit_client', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'delete_client', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'accept_client', 'guard_name' => 'admin']);

        Permission::firstOrCreate(['name' => 'create_service_coach', 'guard_name' => 'coach']);
        Permission::firstOrCreate(['name' => 'edit_service_coach', 'guard_name' => 'coach']);
        Permission::firstOrCreate(['name' => 'delete_service_coach', 'guard_name' => 'coach']);
        Permission::firstOrCreate(['name' => 'show_service_coach', 'guard_name' => 'coach']);

        Permission::firstOrCreate(['name' => 'create_appointment_coach', 'guard_name' => 'coach']);
        Permission::firstOrCreate(['name' => 'edit_appointment_coach', 'guard_name' => 'coach']);
        Permission::firstOrCreate(['name' => 'delete_appointment_coach', 'guard_name' => 'coach']);
        Permission::firstOrCreate(['name' => 'show_appointment_coach', 'guard_name' => 'coach']);

        Permission::firstOrCreate(['name' => 'delete_service', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'show_service', 'guard_name' => 'admin']);

        Permission::firstOrCreate(['name' => 'show_service_client', 'guard_name' => 'client']);

        Permission::firstOrCreate(['name' => 'create_category', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'edit_category', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'delete_category', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'show_category', 'guard_name' => 'admin']);

        Permission::firstOrCreate(['name' => 'show_category_client', 'guard_name' => 'client']);

        Permission::firstOrCreate(['name' => 'edit_setting', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'delete_setting', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'show_setting', 'guard_name' => 'admin']);

        Permission::firstOrCreate(['name' => 'edit_attachment', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'delete_attachment', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'show_attachment', 'guard_name' => 'admin']);

        Permission::firstOrCreate(['name' => 'edit_appointment', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'delete_appointment', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'show_appointment', 'guard_name' => 'admin']);



        Permission::firstOrCreate(['name' => 'show_appointment_client', 'guard_name' => 'client']);

        Permission::firstOrCreate(['name' => 'create_role', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'edit_role', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'delete_role', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'show_role', 'guard_name' => 'admin']);


        Permission::firstOrCreate(['name' => 'create_review_client', 'guard_name' => 'client']);
        Permission::firstOrCreate(['name' => 'edit_review_client', 'guard_name' => 'client']);
        Permission::firstOrCreate(['name' => 'delete_review_client', 'guard_name' => 'client']);
        Permission::firstOrCreate(['name' => 'show_review_client', 'guard_name' => 'client']);

        Permission::firstOrCreate(['name' => 'delete_review', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'show_review', 'guard_name' => 'admin']);

        Permission::firstOrCreate(['name' => 'show_review_coach', 'guard_name' => 'coach']);


        // create roles and assign created permissions

        $role = Role::create(['name' => 'client','guard_name' => 'client'])->givePermissionTo([
            'show_category_client',
            'show_service_client',
            'show_appointment_client',
            'create_review_client',
            'edit_review_client',
            'delete_review_client',
            'show_review_client',
            ]);

        $role = Role::create(['name' => 'admin','guard_name' => 'admin'])->givePermissionTo([
             'edit_category',
             'create_category',
             'show_category',
             'show_service' ,
             'edit_role',
             'show_role',
             'edit_appointment',
             'delete_appointment',
             'show_appointment',
             'show_attachment',
            'edit_attachment',
             'delete_attachment',
            'delete_attachment',
            'show_appointment',
            'delete_appointment',
             'accept_client',
             'delete_client',
            'show_review',]);


            $role = Role::create(['name' => 'coach', 'guard_name' => 'coach'])->givePermissionTo([
             'edit_service_coach',
             'create_service_coach',
             'show_service_coach',
             'delete_service_coach',
             'edit_appointment_coach',
             'create_appointment_coach',
             'show_appointment_coach',
             'delete_appointment_coach',
            'show_review_coach',]);

           $role = Role::create(['name' => 'superadmin','guard_name' => 'admin'])->givePermissionTo([
             'edit_category',
             'create_category',
             'show_category',
             'delete_category',
             'show_service',
             'delete_service',
             'edit_role',
             'create_role',
             'show_role',
             'delete_role',
             'edit_appointment',
             'show_appointment',
             'delete_appointment',
             'edit_attachment',
             'show_attachment',
             'delete_attachment',
            'edit_appointment',
             'show_appointment',
             'delete_appointment',
             'accept_client',
             'delete_client',
             'show_review',
             'delete_review',
            ]);

    }
}
