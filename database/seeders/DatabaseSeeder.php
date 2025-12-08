<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Boq;
use App\Models\BoqItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            MenuSeeder::class,
            AdminMenuSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,       
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProjectSeeder::class,
            ProposalSeeder::class,
            InvoiceSeeder::class,
            BoqSeeder::class,
            // BankSeeder::class,
            PdfTemplateSeeder::class
        ]);
    }
}
