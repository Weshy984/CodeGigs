<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(20)->create();

        $user= User::factory()->create([
            'name' => 'Jimmy Mcfae',
            'email' => 'jimfae@gmail.com'
        ]);

         Job::factory(6)->create([
            'user_id' => $user->id
         ]);


         //Job::create([
         //   'title' => 'Laravel Senior Developer', 
         //   'tags' => 'laravel, javascript',
         //   'company' => 'Acme Corp',
         //   'location' => 'Boston, MA',
         //   'email' => 'email1@email.com',
         //   'website' => 'https://www.acme.com',
         //   'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
         //]);

         //Job::create([
         //   'title' => 'Flutter Junior Developer', 
         //   'tags' => 'flutter, dart,',
         //   'company' => 'Junior Corp',
         //   'location' => 'Newdale, NB',
         //   'email' => 'gmail@1gemail.com',
         //   'website' => 'https://flutter.dev/',
         //   'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
         //]);

    // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
