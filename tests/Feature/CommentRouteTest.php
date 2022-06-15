<?php

namespace Tests\Feature;

use App\Domains\Comment\Models\Comment;
use App\Domains\Product\Models\Product;
use App\Domains\UserRole\Models\User;
use Tests\TestCase;

class CommentRouteTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        // prepare data
        $this->user = factory(User::class)->create();
        $this->product = factory(Product::class)->create();
        $this->comments = factory(Comment::class, 2)->create([
            'product_id' => $this->product->id,
            'user_id'    => $this->user->id,
        ]);
    }

    public function testRouteComments_index_shouldSuccess()
    {
        $response = $this->get(
            '/api/products/' . $this->product->slug . '/comments', 
            $this->setAuth(
                $this->user
            )
        );

        $result = $response->decodeResponseJson();

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

        // check comment
        $this->assertArrayHasKey('id', $result['data']['comments'][0]);
        $this->assertArrayHasKey('content', $result['data']['comments'][0]);
        $this->assertArrayHasKey('created_at', $result['data']['comments'][0]);
        $this->assertArrayHasKey('updated_at', $result['data']['comments'][0]);
        $this->assertArrayHasKey('user', $result['data']['comments'][0]);

        // check user
        $this->assertArrayHasKey('id', $result['data']['comments'][0]['user']);
        $this->assertArrayHasKey('username', $result['data']['comments'][0]['user']);
    }

    // public function testRouteComments_store_shouldSuccess()
    // {
    //     $this->markTestSkipped();
    //     $content = 'comment testing gais';
    //     $request = [
    //         'content' => $content,
    //     ];

    //     Auth::login($this->user);
    //     $response = $this->post(
    //         '/api/products/' . $this->product->slug . '/comments', 
    //         array_merge($this->setAuth(
    //             $this->user
    //         ), $request)
    //     )->decodeResponseJson();

    //     // check comment
    //     $this->assertArrayHasKey('id', $response);
    //     $this->assertArrayHasKey('content', $response);
    //     $this->assertArrayHasKey('created_at', $response);
    //     $this->assertArrayHasKey('updated_at', $response);

    //     // check message
    //     $this->assertEquals('Comment created successfully', $response['full_messages'][0]);

    //     $this->assertEquals($content, $response['content']);
    //     $this->assertEquals(
    //         Comment::where('content', $content)
    //             ->orderBy('created_at', 'DESC')
    //             ->first()
    //             ->content,
    //         $response['content']
    //     );
    // }

    // public function testRouteComments_update_shouldSuccess()
    // {
    //     $content = 'comment testing gais';
    //     $request = [
    //         'content' => $content,
    //     ];

    //     $comment = $this->comments->first();
    //     $firstContent = $comment->content;

    //     // Auth::login($this->user);
    //     $response = $this->put(
    //         sprintf('/api/products/%s/comments/%d',
    //             $this->product,
    //             $comment->id
    //         ),
    //         $request,
    //         $this->setAuth(
    //             $this->user
    //         )
    //     )->decodeResponseJson();

    //     // check comment
    //     $this->assertArrayHasKey('id', $response);
    //     $this->assertArrayHasKey('content', $response);
    //     $this->assertArrayHasKey('created_at', $response);
    //     $this->assertArrayHasKey('updated_at', $response);

    //     // check message
    //     $this->assertEquals('Comment created successfully', $response['full_messages'][0]);

    //     $this->assertEquals($content, $response['content']);
    //     $this->assertEquals(
    //         Comment::where('content', $content)
    //             ->orderBy('created_at', 'DESC')
    //             ->first()
    //             ->content,
    //         $response['content']
    //     );
    // }

    // public function testRouteComments_delete_shouldSuccess()
    // {
    //     $content = 'comment testing gais';
    //     $request = [
    //         'content' => $content,
    //     ];

    //     Auth::login($this->user);
    //     $response = $this->delete(
    //         '/api/products/' . $this->product->slug . '/comments/', 
    //         array_merge($this->setAuth(
    //             $this->user
    //         ), $request)
    //     )->decodeResponseJson();


    //     // check message
    //     $this->assertEquals('Comment deleted successfully', $response['full_messages'][0]);

    //     $this->assertEquals($content, $response['content']);
    //     $this->assertEquals(
    //         Comment::where('content', $content)
    //             ->orderBy('created_at', 'DESC')
    //             ->first()
    //             ->content,
    //         $response['content']
    //     );
    // }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
