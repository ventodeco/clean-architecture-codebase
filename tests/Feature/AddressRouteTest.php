<?php

namespace Tests\Feature;

use App\Domains\Address\Models\Address;
use App\Domains\UserRole\Models\User;
use Tests\TestCase;

class AddressRouteTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        // prepare data
        $this->user = factory(User::class)->create();
        $this->addressess = factory(Address::class, 2)->create([
            'user_id' => $this->user->id,
        ]);
    }

    public function testRouteAddress_index_shouldSuccess()
    {
        $result = $this->get(
            '/api/addresses', 
            $this->setAuth(
                $this->user
            )
        )->decodeResponseJson();

        // check page meta
        $this->assertArrayHasKey('page_meta', $result);
        $this->assertArrayHasKey('has_next_page', $result['page_meta']);
        $this->assertArrayHasKey('has_prev_page', $result['page_meta']);
        $this->assertArrayHasKey('next_page_number', $result['page_meta']);
        $this->assertArrayHasKey('prev_page_number', $result['page_meta']);
        $this->assertArrayHasKey('next_page_url', $result['page_meta']);
        $this->assertArrayHasKey('offset', $result['page_meta']);
        $this->assertArrayHasKey('requested_page_size', $result['page_meta']);
        $this->assertArrayHasKey('total_items_count', $result['page_meta']);
        $this->assertArrayHasKey('current_items_count', $result['page_meta']);
        $this->assertArrayHasKey('page_count', $result['page_meta']);
        $this->assertArrayHasKey('current_page_number', $result['page_meta']);

        // check tags
        $this->assertArrayHasKey('id', $result['addresses'][0]);
        $this->assertArrayHasKey('city', $result['addresses'][0]);
        $this->assertArrayHasKey('address', $result['addresses'][0]);
        $this->assertArrayHasKey('country', $result['addresses'][0]);
        $this->assertArrayHasKey('zip_code', $result['addresses'][0]);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
