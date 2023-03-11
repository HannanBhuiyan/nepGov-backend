<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = ['dashboard','user edit','user view','user delete','user group assign','user group create','user survay question create','user survay question edit','user survay question delete','send mail','role permission create','assign role to users','permission edit', 'admin create', 'news create','news view','news edit', 'news delete','category create','category edit','category delete', 'role add','role delete','role assign permission','crime create','crime view','crime edit', 'crime delete','crime question create','crime question edit', 'crime question delete', 'general settings edit','social link settings edit','page create','page view','page edit', 'page delete','normal topic create','normal topic edit', 'normal topic delete', 'live category create','live category edit', 'live category delete', 'live topic create','live topic edit', 'live topic delete','live question create','live question edit', 'live question delete','template'];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
