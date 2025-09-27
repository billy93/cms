<?php

namespace Database\Factories;

use App\Models\Boq;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoqFactory extends Factory
{
    protected $model = Boq::class;

    public function definition(): array
    {
        $formTypes = ['type-a', 'type-b', 'type-c', 'type-d'];
        $formType = $this->faker->randomElement($formTypes);

        return [
            'project_id' => null, // optional
            'proposal_id' => null, // optional
            'description' => $this->faker->sentence(),
            'form_type' => $formType,
            'basic_price' => $this->faker->randomFloat(2, 1000, 5000),
            'management_fee' => $this->faker->randomFloat(2, 100, 1000),
            'management_fee_type' => $this->faker->randomElement(['percent', 'nominal']),
            'sales_amount' => $this->faker->randomFloat(2, 5000, 20000),
            'vat' => $this->faker->randomFloat(2, 100, 2000),
            'vat_rate' => $this->faker->randomElement(['1', '11']),
            'invoice_amount' => $this->faker->randomFloat(2, 6000, 25000),
        ];
    }
}
