<?php

namespace Database\Factories;

use App\Models\BoqItem;
use App\Models\Boq;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoqItemFactory extends Factory
{
    protected $model = BoqItem::class;

    public function definition(): array
    {
     
        // Snapshot product
        $snapshotPrice = $this->faker->randomFloat(2, 100, 2000);

        // Title values
        $title1 = $this->faker->numberBetween(1, 5);
        $title2 = $this->faker->numberBetween(1, 5);
        $title3 = $this->faker->numberBetween(1, 5);
        $title4 = $this->faker->numberBetween(1, 5);

        return [
            'boq_id' => Boq::factory(),
            'header' => $this->faker->randomElement(['Description', 'Pricing Model', 'Management Fee']),
            'subheader' => $this->faker->randomElement(['Adult', 'Child', 'Infant', null]),
            'product_id' => null, // optional
            'snapshot_product_name' => $this->faker->word(),
            'snapshot_product_price' => $snapshotPrice,
            'title1_key' => 'Qty',
            'title1_value' => $title1,
            'title2_key' => 'Multiplier',
            'title2_value' => $title2,
            'title3_key' => 'Factor',
            'title3_value' => $title3,
            'title4_key' => 'Extra',
            'title4_value' => $title4,
            'multiplier_total' => $snapshotPrice * $title1 * $title2 * $title3 * $title4,
        ];
    }
}
