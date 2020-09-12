<?php

namespace App\Tests\Feature;

use App\Tests\TestCase;
use App\Label;

class LabelControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        factory(Label::class, 2)->create();
    }


    public function testCreate()
    {
        $this->get(route('labels.create'))->assertOk();
    }

    public function testIndex()
    {
        $this->get(route('labels.index'))->assertOk();
    }

    public function testEdit()
    {
        $label = factory(Label::class)->create();
        $this->get(route('labels.edit', $label))->assertOk();
    }

    public function testStore()
    {
        $factoryData = factory(Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $this->post(route('labels.store'), $data)->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdate()
    {
        $label = factory(Label::class)->create();
        $factoryData = factory(Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $this->put(route('labels.update', $label), $data)
             ->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $label = factory(Label::class)->create();
        $this->delete(route('labels.destroy', $label))
             ->assertRedirect();

        $this->assertDatabaseHas('labels', ['id' => $label->id]);
    }
}
