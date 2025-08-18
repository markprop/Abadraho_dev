<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Area;
use App\Models\Builder;
use App\Models\InstallmentType;
use App\Models\Measurement;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Review;
use App\Models\RoomType;
use App\Models\Team;
use App\Models\Unit;
use App\Models\User;
use App\Models\User_type;
use App\Models\ZohoForm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed User_types
        User_type::create(['user_type_name' => 'admin', 'isActive' => 1, 'created_by' => 1, 'updated_by' => 1]);
        User_type::create(['user_type_name' => 'buyer', 'isActive' => 1, 'created_by' => 1, 'updated_by' => 1]);
        User_type::create(['user_type_name' => 'agent', 'isActive' => 1, 'created_by' => 1, 'updated_by' => 1]);

        // Create users with random user_type_id
        User::factory(20)->create()->each(function ($user) {
            $userTypes = User_type::whereIn('user_type_name', ['buyer', 'agent'])->pluck('id')->toArray();
            $user->update(['user_type_id' => $userTypes[array_rand($userTypes)]]);
        });

        // Create builders
        Builder::factory(20)->create();

        // Create admin user with admin user_type_id
        $adminUserType = User_type::where('user_type_name', 'admin')->first();
        Admin::create([
            'name' => 'Ali',
            'email' => 'ali@test.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'user_type_id' => $adminUserType ? $adminUserType->id : 1, // Default to 1 if not found
        ]);

        // Seed ProjectTypes
        ProjectType::create(['title' => 'Apartments']);
        ProjectType::create(['title' => 'Villas']);
        ProjectType::create(['title' => 'Commercials']);
        ProjectType::create(['title' => 'Plots']);
        ProjectType::create(['title' => 'Bungalows']);
        ProjectType::create(['title' => 'Offices']);

        // Seed RoomTypes
        RoomType::create(['name' => 'Bedroom']);
        RoomType::create(['name' => 'Washroom']);
        RoomType::create(['name' => 'Kitchen']);
        RoomType::create(['name' => 'Balcony']);
        RoomType::create(['name' => 'Drawing']);
        RoomType::create(['name' => 'Lounge']);

        // Seed Measurements
        Measurement::create(['name' => 'Square Feet', 'symbol' => 'Sq. Ft', 'convertor' => 1]);
        Measurement::create(['name' => 'Square Yard', 'symbol' => 'Sq. Yd', 'convertor' => 9]);
        Measurement::create(['name' => 'Square Meter', 'symbol' => 'Sq. M', 'convertor' => 10.7639]);
        Measurement::create(['name' => 'Marla', 'symbol' => 'Marla', 'convertor' => 272.251]);
        Measurement::create(['name' => 'Kanal', 'symbol' => 'Kanal', 'convertor' => 5445]);

        // Seed InstallmentTypes
        InstallmentType::create(['name' => 'Monthly', 'value' => 1]);
        InstallmentType::create(['name' => 'Quarterly', 'value' => 3]);
        InstallmentType::create(['name' => 'Half-Yearly', 'value' => 6]);
        InstallmentType::create(['name' => 'Yearly', 'value' => 12]);

        // Create projects and units
        Project::factory(10)->create();
        Unit::factory(25)->create();

        // Seed project_owners
        for ($i = 0; $i < 100; $i++) {
            $projectIds = DB::table('projects')->pluck('id');
            $builderIds = DB::table('builders')->pluck('id');
            DB::table('project_owners')->insert([
                'builder_id' => $builderIds->random(),
                'project_id' => $projectIds->random(),
            ]);
        }

        // Seed ZohoForms
        ZohoForm::factory(20)->create();

        // Commented-out sections remain unchanged
        // for ($i = 0; $i < 50; $i++) {
        //     $projectIds = DB::table('projects')->pluck('id');
        //     $userIds = DB::table('users')->pluck('id');
        //     DB::table('project_users')->insert([
        //         'user_id' => $userIds->random(),
        //         'project_id' => $projectIds->random(),
        //     ]);
        // }

        // Unit::factory(400)->create();
        // for ($i = 0; $i < 50; $i++) {
        //     $unitIds = DB::table('units')->pluck('id');
        //     $roomTypeIds = DB::table('room_types')->pluck('id');
        //     $width = rand(2, 5);
        //     $length = rand(2, 5);
        //     $area = $width * $length;
        //     DB::table('room_type_unit')->insert([
        //         'unit_id' => $unitIds->random(),
        //         'room_type_id' => $roomTypeIds->random(),
        //         'width' => $width,
        //         'length' => $length,
        //         'covered_area' => $area,
        //     ]);
        // }

        // Review::factory(30)->create();

        // Team::factory(20)->create();

        // for ($i = 0; $i < 100; $i++) {
        //     $teamIds = DB::table('teams')->pluck('id');
        //     $userIds = DB::table('users')->pluck('id');
        //     DB::table('team_users')->insert([
        //         'team_id' => $teamIds->random(),
        //         'user_id' => $userIds->random(),
        //         'status' => (bool) random_int(0, 1),
        //     ]);
        // }

        // for ($i = 0; $i < 100; $i++) {
        //     $teamIds = DB::table('teams')->pluck('id');
        //     $builderIds = DB::table('builders')->pluck('id');
        //     DB::table('team_builders')->insert([
        //         'team_id' => $teamIds->random(),
        //         'builder_id' => $builderIds->random(),
        //         'status' => (bool) random_int(0, 1),
        //     ]);
        // }

        // for ($i = 0; $i < 40; $i++) {
        //     $teamIds = DB::table('teams')->pluck('id');
        //     $projectIds = DB::table('projects')->pluck('id');
        //     DB::table('team_projects')->insert([
        //         'team_id' => $teamIds->random(),
        //         'project_id' => $projectIds->random(),
        //     ]);
        // }
    }
}