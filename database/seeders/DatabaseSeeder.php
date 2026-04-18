<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this-> call([
            StateSeeder::class,
            CitySeeder::class,
            CompanyPaymentDatesSeeder::class,
            ContractTypesSeeder::class,
            CustomerPaymentDatesSeeder::class,
            LevelStudiesSeeder::class,
            MartitalStatusSeeder::class,
            UserSeeder::class,
            PaymentFrequencySeeder::class,
            PhonetypesSeeder::class,
            QualityHolderSeeder::class,
            EPSSeeder::class,
            ARLSeeder::class,
            WarrantiesSeeder::class,
            DocumentTypeSeeder::class,
            HomeworkStateSeeder::class,
            HomeworkTypeSeeder::class,
            NewnessStateSeeder::class,
            NewnessTypeSeeder::class,
            StatePoliciesSeeder::class,
            AuthorizationPolicySeeder::class,
            PrioritySeeder::class
            ]);


    }
}
