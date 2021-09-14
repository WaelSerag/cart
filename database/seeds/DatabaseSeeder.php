<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(CompetitionsSeeder::class);
        $this->call(TicketsSeeder::class);
        $this->call(SponsorsSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(SlidesSeeder::class);
        $this->call(TestimonialsSeeder::class);
        $this->call(SupportDocumentsSeeder::class);
        $this->call(TrainingDocumentsSeeder::class);
        $this->call(LevelsSeeder::class);

    }
}
 