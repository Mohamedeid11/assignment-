<?php

use App\Models\Project;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class ProjectFilterTest extends TestCase
{
    /**
     * Test filtering projects by department.
     *
     * @return void
     */
    public function test_filter_projects_by_department()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $departmentAttribute = Attribute::create([
            'name' => 'department',
            'type' => 'text',
        ]);

        $project1 = Project::create(['name' => 'Project Alpha', 'status' => 'active']);
        $project2 = Project::create(['name' => 'Project Beta', 'status' => 'inactive']);

        AttributeValue::create([
            'attribute_id' => $departmentAttribute->id,
            'entity_id' => $project1->id,
            'entity_type' => Project::class,
            'value' => 'IT',
        ]);

        AttributeValue::create([
            'attribute_id' => $departmentAttribute->id,
            'entity_id' => $project2->id,
            'entity_type' => Project::class,
            'value' => 'HR',
        ]);

        $response = $this->getJson('/api/projects?filters[department]=IT&filters[operator]==');

        $response->assertStatus(200)
            ->assertJsonCount(4)
            ->assertJson([
                'data' => [
                    [
                        'name' => 'Project Alpha',
                        'status' => 'active',
                        'dynamic_attributes' => [
                            'department' => 'IT',
                        ],
                    ],
                ],
            ]);
    }
}
