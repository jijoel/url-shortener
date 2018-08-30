<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\ShortUrl;


class ShortUrlTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_load_the_home_page()
    {
        $this->get('/')
            ->assertStatus(200);
    }

    /** @test */
    public function user_is_redirected_from_short_link()
    {
        $link = factory(ShortUrl::class)->create();

        $this->get('/'.$link->short)
            ->assertRedirect($link->long);
    }

    /** @test */
    public function user_sent_to_home_page_if_link_not_found()
    {
        $this->get('/x')
            ->assertStatus(200);
    }

    /** @test */
    public function urls_are_required()
    {
        $this->postJson('/', [])
            ->assertStatus(422);
    }

    /** @test */
    public function invalid_urls_return_validation_error()
    {
        $this->postJson('/', ['url' => 'foo'])
            ->assertStatus(422);
    }

    /** @test */
    public function user_can_create_link()
    {
        $this->postJson('/', ['url' => 'http://google.com'])
            ->assertStatus(201)
            ->assertJsonStructure(['short']);
    }

    /** @test */
    public function creating_duplicate_returns_first_link()
    {
        $this->withoutExceptionHandling();
        $this->postJson('/', ['url' => 'http://google.com']);
        $this->postJson('/', ['url' => 'http://google.com'])
            ->assertStatus(200);
    }

}
