<?php

namespace App\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Tests\TestCase;

class LabelControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get(route('labels.create'))->assertSuccessful();
    }

    public function testIndex()
    {
        $this->get(route('labels.index'))->assertSuccessful();
    }

    public function testEdit()
    {
        $this->get(route('labels.edit', ['label' => 1]))->assertSuccessful();
    }

    public function testStore()
    {
        $params = ['name' => 'firefox'];
        $this->post(route('labels.store'), $params)->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas('labels', ['name' => 'firefox']);
    }

    public function testUpdate()
    {
        $params = ['name' => 'chrome'];
        $this->put(route('labels.update', ['label' => 1]), $params)
             ->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas('labels', ['name' => 'chrome']);
    }

    public function testDestroy()
    {
        $this->delete(route('labels.destroy', ['label' => 1]))
             ->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas('labels', ['id' => 1]);
    }
}
