<?php

namespace App\Tests\Feature;

use App\Tests\TestCase;
use App\Label;
use App\User;

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
        $user = factory(User::class)->create();
        $this->be($user);

        $factoryData = factory(Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $label = factory(Label::class)->create();
        $factoryData = factory(Label::class)->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->put(route('labels.update', $label), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $label = factory(Label::class)->create();
        $response = $this->delete(route('labels.destroy', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', ['id' => $label->id]);
    }
}
