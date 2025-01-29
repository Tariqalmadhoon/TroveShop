<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions =[
            'all_categories' => 'Show all categories',
            'add_category' => 'Add category',
            'edit_category' => 'Edit category',
            'delete_category' => 'Delete category',
            'all_product' => 'Show all products',
            'add_product' => 'Add product',
            'edit_product' => 'Edit product',
            'delete_product' => 'Delete product',

        ];
        Permission::truncate();
        foreach ($permissions as $code =>$name){
            Permission::create([
                'code' =>$code,
                'name' =>$name,
            ]);
        }
    }
}
