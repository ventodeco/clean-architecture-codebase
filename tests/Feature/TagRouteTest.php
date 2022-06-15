<?php

namespace Tests\Feature;

use App\Domains\Tag\Models\Tag;
use App\Domains\UserRole\Models\User;
use Tests\TestCase;

class TagRouteTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        // prepare data
        $this->user = factory(User::class)->create();
        $this->tags = factory(Tag::class, 2)->create();
    }

    public function testRouteTags_index_shouldSuccess()
    {
        $result = $this->get(
            '/api/tags', 
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
        $this->assertArrayHasKey('id', $result['tags'][0]);
        $this->assertArrayHasKey('name', $result['tags'][0]);
        $this->assertArrayHasKey('slug', $result['tags'][0]);
        $this->assertArrayHasKey('description', $result['tags'][0]);
        $this->assertArrayHasKey('image_urls', $result['tags'][0]);
    }

    public function testRouteTags_store_shouldSuccess()
    {
        $request = [
            'name'        => 'vento deco',
            'description' => 'tesss'
        ];

        $result = $this->post(
            '/api/tags', 
            array_merge($this->setAuth(
                $this->user
            ), $request)
        )->decodeResponseJson();

        // check tags
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('slug', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('image_urls', $result);

        // check tags
        $this->assertEquals('vento-deco', $result['slug']);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
