<?php

namespace Tests\Feature;

use App\Domains\Address\Models\Address;
use App\Domains\Ordering\Models\Order;
use App\Domains\Product\Models\Product;
use App\Domains\UserRole\Models\User;
use Tests\TestCase;

class OrderRouteTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        // prepare data
        $this->user = factory(User::class)->create();
        $this->address = factory(Address::class)->create([
            'user_id' => $this->user->id,
        ]);
        $this->orders = factory(Order::class, 2)->create([
            'user_id'      => $this->user->id,
            'order_status' => 0,
        ]);

        $this->product = factory(Product::class)->create();
    }

    public function testRouteOrders_index_shouldSuccess()
    {
        $response = $this->get(
            '/api/orders', 
            $this->setAuth(
                $this->user
            )
        );

        $result = $response->decodeResponseJson();
    
        // check order
        $this->assertTrue($result['success']);
        $this->assertEquals(
            $this->orders->pluck('id')->toArray(),
            array_column($result['data']['orders'], 'id')
        );

        // check page meta
        $this->assertArrayHasKey('page_meta', $result['data']);
        $this->assertArrayHasKey('has_next_page', $result['data']['page_meta']);
        $this->assertArrayHasKey('has_prev_page', $result['data']['page_meta']);
        $this->assertArrayHasKey('next_page_number', $result['data']['page_meta']);
        $this->assertArrayHasKey('prev_page_number', $result['data']['page_meta']);
        $this->assertArrayHasKey('next_page_url', $result['data']['page_meta']);
        $this->assertArrayHasKey('offset', $result['data']['page_meta']);
        $this->assertArrayHasKey('requested_page_size', $result['data']['page_meta']);
        $this->assertArrayHasKey('total_items_count', $result['data']['page_meta']);
        $this->assertArrayHasKey('current_items_count', $result['data']['page_meta']);
        $this->assertArrayHasKey('page_count', $result['data']['page_meta']);
        $this->assertArrayHasKey('current_page_number', $result['data']['page_meta']);


        // check order
        $this->assertArrayHasKey('id', $result['data']['orders'][0]);
        $this->assertArrayHasKey('tracking_number', $result['data']['orders'][0]);
        $this->assertArrayHasKey('order_status', $result['data']['orders'][0]);
        $this->assertArrayHasKey('order_items_count', $result['data']['orders'][0]);
        $this->assertArrayHasKey('total', $result['data']['orders'][0]);

        $response->assertStatus(200);
    }

    public function testOrders_show_shouldSuccess()
    {
        $id = $this->orders->first()->id;

        $response = $this->get(
            '/api/orders/' . $id, 
            $this->setAuth(
                $this->user
            )
        );

        $result = $response->decodeResponseJson();

        // check array
        $this->assertArrayHasKey('success', $result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('tracking_number', $result);
        $this->assertArrayHasKey('order_status', $result);
        $this->assertArrayHasKey('order_items_count', $result);
        $this->assertArrayHasKey('total', $result);

        // check equal
        $this->assertEquals('ordered', $result['order_status']);
        $this->assertEquals($id, $result['id']);
        $this->assertTrue($result['success']);
    }

    public function testOrders_store_shouldSuccess()
    {
        $request = [
            "address"      => "Patuk Kidul",
            "first_name"   => "Vento",
            "last_name"    => "Deco",
            "zip_code"     => "57673",
            "city"         => "Wonogiri",
            "country"      => "Indonesia",
            "phone_number" => "091823",
            "cart_items"   => [
                [
                    "id" => $this->product->id,
                    "quantity" => 2,
                ],
            ],
        ];

        $response = $this->post(
            '/api/orders',
            array_merge($this->setAuth(
                $this->user
            ), $request)
        );

        $result = $response->decodeResponseJson();

        // check array
        $this->assertArrayHasKey('success', $result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('tracking_number', $result);
        $this->assertArrayHasKey('order_status', $result);
        $this->assertArrayHasKey('order_items_count', $result);
        $this->assertArrayHasKey('total', $result);

        // check address
        $address = Address::where('address', $request['address'])
                    ->where('zip_code', $request['zip_code'])
                    ->first();

        $this->assertEquals($address['first_name'], $request['first_name']);
        $this->assertEquals($address['last_name'], $request['last_name']);
        $this->assertEquals($address['zip_code'], $request['zip_code']);
        $this->assertEquals($address['city'], $request['city']);
        $this->assertEquals($address['address'], $request['address']);
        $this->assertEquals($address['phone_number'], $request['phone_number']);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
