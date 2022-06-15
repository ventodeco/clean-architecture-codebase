<?php

namespace Tests\Feature;

use App\Domains\Category\Models\Category;
use App\Domains\Product\Models\Product;
use App\Domains\Tag\Models\Tag;
use App\Domains\UserRole\Models\User;
use Tests\TestCase;

class ProductRouteTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        // prepare data
        $this->user = factory(User::class)->create();
        $this->products = factory(Product::class, 2)->create();

        $category = factory(Category::class)->create();
        $tag = factory(Tag::class)->create();

        $product = $this->products->first();
        $product->categories()->attach($category);
        $product->tags()->attach($tag);

        $this->category = $product->categories->first();
        $this->tag = $product->tags->first();
    }

    public function testRouteProduct_index_shouldSuccess()
    {
        $response = $this->get(
            '/api/products', 
            $this->setAuth(
                $this->user
            )
        )->decodeResponseJson();

        // check product
        $this->assertTrue($response['success']);
        $this->assertEquals(
            $this->products->pluck('id')->toArray(),
            array_column($response['products'], 'id')
        );

        // check page meta
        $this->assertArrayHasKey('page_meta', $response);
        $this->assertArrayHasKey('has_next_page', $response['page_meta']);
        $this->assertArrayHasKey('has_prev_page', $response['page_meta']);
        $this->assertArrayHasKey('next_page_number', $response['page_meta']);
        $this->assertArrayHasKey('prev_page_number', $response['page_meta']);
        $this->assertArrayHasKey('next_page_url', $response['page_meta']);
        $this->assertArrayHasKey('offset', $response['page_meta']);
        $this->assertArrayHasKey('requested_page_size', $response['page_meta']);
        $this->assertArrayHasKey('total_items_count', $response['page_meta']);
        $this->assertArrayHasKey('current_items_count', $response['page_meta']);
        $this->assertArrayHasKey('page_count', $response['page_meta']);
        $this->assertArrayHasKey('current_page_number', $response['page_meta']);


        // check product
        $this->assertArrayHasKey('id', $response['products'][0]);
        $this->assertArrayHasKey('name', $response['products'][0]);
        $this->assertArrayHasKey('slug', $response['products'][0]);
        $this->assertArrayHasKey('price', $response['products'][0]);
        $this->assertArrayHasKey('stock', $response['products'][0]);
        $this->assertArrayHasKey('comments_count', $response['products'][0]);
        $this->assertArrayHasKey('image_urls', $response['products'][0]);
    }

    public function testRouteProduct_showSlug_shouldSuccess()
    {
        $product = $this->products->first();
        $response = $this->get(
            '/api/products/' . $product->slug, 
            $this->setAuth(
                $this->user
            )
        )->decodeResponseJson();

        // check product
        $this->assertEquals($product->id, $response['id']);
        $this->assertEquals($product->name, $response['name']);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('slug', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('comments', $response);
        $this->assertArrayHasKey('categories', $response);
        $this->assertArrayHasKey('tags', $response);
        $this->assertArrayHasKey('views', $response);
        $this->assertArrayHasKey('image_urls', $response);
    }

    public function testRouteProduct_getById_shouldSuccess()
    {
        $product = $this->products->first();
        $response = $this->get(
            '/api/products/by_id/' . $product->id, 
            $this->setAuth(
                $this->user
            )
        )->decodeResponseJson();

        // check product
        $this->assertEquals($product->id, $response['id']);
        $this->assertEquals($product->name, $response['name']);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('slug', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('comments', $response);
        $this->assertArrayHasKey('categories', $response);
        $this->assertArrayHasKey('tags', $response);
        $this->assertArrayHasKey('views', $response);
        $this->assertArrayHasKey('image_urls', $response);
    }

    public function testRouteProduct_getByCategory_shouldSuccess()
    {
        $response = $this->get(
            '/api/products/by_category/' . $this->category->slug, 
            $this->setAuth(
                $this->user
            )
        )->decodeResponseJson();

        // check page meta
        $this->assertArrayHasKey('page_meta', $response);
        $this->assertArrayHasKey('has_next_page', $response['page_meta']);
        $this->assertArrayHasKey('has_prev_page', $response['page_meta']);
        $this->assertArrayHasKey('next_page_number', $response['page_meta']);
        $this->assertArrayHasKey('prev_page_number', $response['page_meta']);
        $this->assertArrayHasKey('next_page_url', $response['page_meta']);
        $this->assertArrayHasKey('offset', $response['page_meta']);
        $this->assertArrayHasKey('requested_page_size', $response['page_meta']);
        $this->assertArrayHasKey('total_items_count', $response['page_meta']);
        $this->assertArrayHasKey('current_items_count', $response['page_meta']);
        $this->assertArrayHasKey('page_count', $response['page_meta']);
        $this->assertArrayHasKey('current_page_number', $response['page_meta']);

        // check product
        $this->assertTrue($response['success']);
        $this->assertArrayHasKey('products', $response);
        $this->assertArrayHasKey('id', $response['products'][0]);
        $this->assertArrayHasKey('name', $response['products'][0]);
        $this->assertArrayHasKey('slug', $response['products'][0]);
        $this->assertArrayHasKey('price', $response['products'][0]);
        $this->assertArrayHasKey('stock', $response['products'][0]);
        $this->assertArrayHasKey('comments_count', $response['products'][0]);
        $this->assertArrayHasKey('image_urls', $response['products'][0]);
    }

    public function testRouteProduct_getByTag_shouldSuccess()
    {
        $response = $this->get(
            '/api/products/by_tag/' . $this->tag->slug, 
            $this->setAuth(
                $this->user
            )
        )->decodeResponseJson();

        // check page meta
        $this->assertArrayHasKey('page_meta', $response);
        $this->assertArrayHasKey('has_next_page', $response['page_meta']);
        $this->assertArrayHasKey('has_prev_page', $response['page_meta']);
        $this->assertArrayHasKey('next_page_number', $response['page_meta']);
        $this->assertArrayHasKey('prev_page_number', $response['page_meta']);
        $this->assertArrayHasKey('next_page_url', $response['page_meta']);
        $this->assertArrayHasKey('offset', $response['page_meta']);
        $this->assertArrayHasKey('requested_page_size', $response['page_meta']);
        $this->assertArrayHasKey('total_items_count', $response['page_meta']);
        $this->assertArrayHasKey('current_items_count', $response['page_meta']);
        $this->assertArrayHasKey('page_count', $response['page_meta']);
        $this->assertArrayHasKey('current_page_number', $response['page_meta']);

        // check product
        $this->assertTrue($response['success']);
        $this->assertArrayHasKey('products', $response);
        $this->assertArrayHasKey('id', $response['products'][0]);
        $this->assertArrayHasKey('name', $response['products'][0]);
        $this->assertArrayHasKey('slug', $response['products'][0]);
        $this->assertArrayHasKey('price', $response['products'][0]);
        $this->assertArrayHasKey('stock', $response['products'][0]);
        $this->assertArrayHasKey('comments_count', $response['products'][0]);
        $this->assertArrayHasKey('image_urls', $response['products'][0]);
    }

    public function testRouteProduct_byId_shouldSuccess()
    {
        $product = $this->products->first();
        $response = $this->get(
            '/api/products/by_id/' . $product->id, 
            $this->setAuth(
                $this->user
            )
        )->decodeResponseJson();

        // check product
        $this->assertEquals($product->id, $response['id']);
        $this->assertEquals($product->name, $response['name']);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('slug', $response);
        $this->assertArrayHasKey('description', $response);
        $this->assertArrayHasKey('comments', $response);
        $this->assertArrayHasKey('categories', $response);
        $this->assertArrayHasKey('tags', $response);
        $this->assertArrayHasKey('views', $response);
        $this->assertArrayHasKey('image_urls', $response);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
