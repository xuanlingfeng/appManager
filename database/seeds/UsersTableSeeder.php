<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'work_order' => 'admin',
                'password' => bcrypt('123456'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),                
            ],
       
        ]);
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => '超级管理员',
                'description' => '超级管理员',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),                
            ],
       
        ]);

        DB::table('role_user')->insert([
            [
                'user_id'      => '1',
                'role_id'      => '1',
            ],
        ]);

        DB::table('permission_role')->insert([
            [
                'role_id'      => '1',
                'permission_id'=> '1',
            ], 

        ]);  
        
        DB::table('permissions')->insert([ 
        	[	
        		'name' => 'admin',
  				'display_name' => '超级管理',
                'description'  => '超级管理员',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()        		
        	],
       	       	
        ]);
    
    }
}
