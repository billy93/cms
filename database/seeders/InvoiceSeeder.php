<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // foreach (range(1, 10) as $i) {
        //     DB::table('invoice')->insert([
        //         'client_id' => $faker->optional()->numberBetween(1, 50),
        //         'bill_to' => $faker->company,
        //         'ship_to' => $faker->address,
        //         'project_id' => $faker->optional()->numberBetween(1, 50),
        //         'amount' => $faker->randomFloat(2, 1000, 10000),
        //         'currency' => $faker->randomElement(['USD', 'EUR', 'IDR']),
        //         'invoice_date' => $faker->date(),
        //         'due_date' => $faker->dateTimeBetween('+5 days', '+30 days')->format('Y-m-d'),
        //         'payment_method' => $faker->randomElement(['bank transfer', 'credit card', 'cash']),
        //         'status' => $faker->randomElement(['pending', 'paid', 'canceled']),
        //         'description' => $faker->paragraph,
        //         'signature_name' => $faker->name,
        //         'signature_image' => null, // or $faker->imageUrl() if needed
        //         'notes' => $faker->sentence,
        //         'terms_and_conditions' => $faker->text(200),
        //         'subtotal' => 0,
        //         'discount' => $faker->randomFloat(2, 0, 10),
        //         'extra_discount' => $faker->randomFloat(2, 0, 5),
        //         'tax' => $faker->randomFloat(2, 10, 100),
        //         'total' => 0, // optional: bisa hitung dari logic subtotal-discount+tax
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
        // Invoice::create([
        //     'proposal_id' => 8,
        //     'customer_id' => 1,
        //     'code' => strtoupper('INV-'.Str::random(6)),
        //     'invoice_date' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
        //     'due_date' => $faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
        //     'status' => 'Unpaid',
        //     'type' => $faker->randomElement(['Full','Partial']),
        //     'payment_method' => $faker->randomElement(['Bank Transfer','Credit Card','Cash','E-Wallet']),
        //     'bill_to' => $faker->company,
        //     'ship_to' => $faker->address,
        //     'total_amount' => $faker->randomFloat(2, 100, 10000),
        //     'note' => $faker->sentence,
        //     'terms_and_conditions' => $faker->paragraph,
        //     'signature_name' => $faker->name,
        //     'signature_image' => null, // Bisa diisi path dummy
        // ]);
    }
}
