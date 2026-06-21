<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['first_name' => 'Rahul',    'last_name' => 'Sharma',    'email' => 'rahul.sharma@example.com',    'mobile' => '9876543210', 'department' => 'Engineering',  'status' => 'active'],
            ['first_name' => 'Priya',    'last_name' => 'Patel',     'email' => 'priya.patel@example.com',     'mobile' => '9876543211', 'department' => 'Marketing',    'status' => 'active'],
            ['first_name' => 'Amit',     'last_name' => 'Kumar',     'email' => 'amit.kumar@example.com',      'mobile' => '9876543212', 'department' => 'HR',           'status' => 'active'],
            ['first_name' => 'Sneha',    'last_name' => 'Reddy',     'email' => 'sneha.reddy@example.com',     'mobile' => '9876543213', 'department' => 'Finance',      'status' => 'active'],
            ['first_name' => 'Vikram',   'last_name' => 'Singh',     'email' => 'vikram.singh@example.com',    'mobile' => '9876543214', 'department' => 'Engineering',  'status' => 'inactive'],
            ['first_name' => 'Ananya',   'last_name' => 'Gupta',     'email' => 'ananya.gupta@example.com',    'mobile' => '9876543215', 'department' => 'Sales',        'status' => 'active'],
            ['first_name' => 'Karthik',  'last_name' => 'Nair',      'email' => 'karthik.nair@example.com',    'mobile' => '9876543216', 'department' => 'Operations',   'status' => 'active'],
            ['first_name' => 'Divya',    'last_name' => 'Joshi',     'email' => 'divya.joshi@example.com',     'mobile' => '9876543217', 'department' => 'HR',           'status' => 'inactive'],
            ['first_name' => 'Arjun',    'last_name' => 'Menon',     'email' => 'arjun.menon@example.com',     'mobile' => '9876543218', 'department' => 'Finance',      'status' => 'active'],
            ['first_name' => 'Meera',    'last_name' => 'Iyer',      'email' => 'meera.iyer@example.com',      'mobile' => '9876543219', 'department' => 'Marketing',    'status' => 'active'],
            ['first_name' => 'Rohan',    'last_name' => 'Desai',     'email' => 'rohan.desai@example.com',     'mobile' => '9876543220', 'department' => 'Engineering',  'status' => 'active'],
            ['first_name' => 'Kavitha',  'last_name' => 'Rao',       'email' => 'kavitha.rao@example.com',     'mobile' => '9876543221', 'department' => 'Sales',        'status' => 'inactive'],
            ['first_name' => 'Sanjay',   'last_name' => 'Verma',     'email' => 'sanjay.verma@example.com',    'mobile' => '9876543222', 'department' => 'Operations',   'status' => 'active'],
            ['first_name' => 'Lakshmi',  'last_name' => 'Pillai',    'email' => 'lakshmi.pillai@example.com',  'mobile' => '9876543223', 'department' => 'Finance',      'status' => 'active'],
            ['first_name' => 'Naveen',   'last_name' => 'Chopra',    'email' => 'naveen.chopra@example.com',   'mobile' => '9876543224', 'department' => 'HR',           'status' => 'active'],
            ['first_name' => 'Pooja',    'last_name' => 'Malhotra',  'email' => 'pooja.malhotra@example.com',  'mobile' => '9876543225', 'department' => 'Engineering',  'status' => 'active'],
            ['first_name' => 'Suresh',   'last_name' => 'Babu',      'email' => 'suresh.babu@example.com',     'mobile' => '9876543226', 'department' => 'Marketing',    'status' => 'inactive'],
            ['first_name' => 'Deepika',  'last_name' => 'Agarwal',   'email' => 'deepika.agarwal@example.com', 'mobile' => '9876543227', 'department' => 'Sales',        'status' => 'active'],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($users as $user) {
            $user['created_at'] = $now;
            $user['updated_at'] = $now;
            $this->db->table('users')->insert($user);
        }
    }
}
