<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeValue::create([
            'attribute_id' => 1, // Link to "Department" attribute
            'entity_id' => 1, // Link to the first project
            'entity_type' => 'App\Models\Project', // Polymorphic relationship
            'value' => 'IT',
        ]);

        AttributeValue::create([
            'attribute_id' => 2, // Link to "Start Date" attribute
            'entity_id' => 1, // Link to the first project
            'entity_type' => 'App\Models\Project',
            'value' => '2023-10-01',
        ]);
    }
}
