<?php

namespace Tests\Feature;

use App\Domains\Category\Models\Category;
use App\Domains\UserRole\Models\User;
use Tests\TestCase;

class CategoriesRouteTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        // prepare data
        $this->user = factory(User::class)->create();
        $this->categories = factory(Category::class, 2)->create();
    }

    public function testRouteCategories_index_shouldSuccess()
    {
        $result = $this->get(
            '/api/categories', 
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

        // check categories
        $this->assertArrayHasKey('id', $result['categories'][0]);
        $this->assertArrayHasKey('name', $result['categories'][0]);
        $this->assertArrayHasKey('slug', $result['categories'][0]);
        $this->assertArrayHasKey('description', $result['categories'][0]);
        $this->assertArrayHasKey('image_urls', $result['categories'][0]);
    }

    public function testRouteCategories_store_shouldSuccess()
    {
        $request = [
            'name'        => 'vento deco',
            'description' => 'tesss'
        ];

        $result = $this->post(
            '/api/categories', 
            array_merge($this->setAuth(
                $this->user
            ), $request)
        )->decodeResponseJson();

        // check categories
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('slug', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('image_urls', $result);

        // check categories
        $this->assertEquals('vento-deco', $result['slug']);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
