<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;  

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'tambah-user']);
        Permission::create(['name'=>'edit-user']);
        Permission::create(['name'=>'hapus-user']);
        Permission::create(['name'=>'lihat-user']);

        Permission::create(['name'=>'tambah-rab']);
        Permission::create(['name'=>'hapus-rab']);
        Permission::create(['name'=>'edit-rab']);
        Permission::create(['name'=>'lihat-rab']);

        Permission::create(['name'=>'tambah-barang']);
        Permission::create(['name'=>'hapus-barang']);
        Permission::create(['name'=>'edit-barang']);
        Permission::create(['name'=>'lihat-barang']);

       

        Role::create(['name'=> 'admin']);
        Role::create(['name'=> 'staff']);
        Role::create(['name'=> 'gudang']);
        

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('hapus-user');
        $roleAdmin->givePermissionTo('lihat-user');

        $roleStaff = Role::findByName('staff');
        $roleStaff->givePermissionTo('tambah-rab');
        $roleStaff->givePermissionTo('hapus-rab');
        $roleStaff->givePermissionTo('edit-rab');
        $roleStaff->givePermissionTo('lihat-rab');

        $roleGudang = Role::findByName('gudang');
        $roleGudang->givePermissionTo('tambah-barang');
        $roleGudang->givePermissionTo('hapus-barang');
        $roleGudang->givePermissionTo('edit-barang');
        $roleGudang->givePermissionTo('lihat-barang');

       


    }
}
