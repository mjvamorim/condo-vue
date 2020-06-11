<?php
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Proprietario::class, 100)->create();

        $user = factory(User::class)->create(['email'=>'mjvamorim@gmail.com']);
        Role::create(['name'=>'Admin']);
        $user->assignRole('Admin');
        
        // $faker = \Faker\Factory::create();

        // for($i=0; $i<=100; $i++):
        //     DB::table('articles')
        //         ->insert([
        //             'title' => $faker->sentence,
        //             'body' => $faker->paragraph
        //         ]);
        // endfor;
    }
}
