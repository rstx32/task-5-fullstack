<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class ArticleTest extends TestCase
{


    // // get all article
    // public function test_get_all_article(){
    //     $token = $this->authenticate();

    //     $response = $this->withHeaders(['Authorization' => "Bearer " . $token])->json('GET', 'api/v1/articles');
    //     $response->assertStatus(200);
    // }

    // // show an article
    // public function test_show_an_article(){
    //     $token = $this->authenticate();

    //     $response = $this->withHeaders(['Authorization' => "Bearer " . $token])->json('GET', 'api/v1/articles/1');
    //     $response->assertStatus(200);
    // }

    // // create an article
    // public function test_create_an_article()
    // {
    //     $token = $this->authenticate();

    //     $response = $this->withHeaders(["Authorization" => "Bearer " . $token,])
    //     ->json("POST", "api/v1/articles", [
    //         "title" => "test articles",
    //         "content" => "test content",
    //         "image" => "test image",
    //         "category_id" => "1",
    //         "user_id" => "1",
    //     ]);

    //     $response->assertStatus(200);
    // }

    // use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::create([
            "name" => "test",
            "email" => rand(12345, 678910) . "test@gmail.com",
            "password" => \Hash::make("12345678"),
        ]);

        if (
            !auth()->attempt([
                "email" => $user->email,
                "password" => "12345678",
            ])
        ) {
            return response(["message" => "Login credentials are invaild"]);
        }

        return $accessToken = auth()
            ->user()
            ->createToken("authToken")->accessToken;
    }

    public function test_create_new_article()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders(["Authorization" => "Bearer " . $token,]);
        // Build a non-persisted Property factory model.
        $newArticle = Article::factory()->make();

        $response = $this->postJson(
            route("article.store"),
            $newArticle->toArray()
        );
        // We assert that we get back a status 201:
        // Resource Created for now.
        $response->assertCreated();
        // Assert that at least one column gets returned from the response
        // in the format we need .
        $response->assertJson([
            "data" => [
                "title" => $newArticle->title,
                "content" => $newArticle->content,
                "image" => $newArticle->image,
                "category_id" => $newArticle->category_id,
                "user_id" => $newArticle->user_id,
            ],
        ]);
        // Assert the table properties contains the factory we made.
        $this->assertDatabaseHas("articles", $newArticle->toArray());
    }

    // public function test_get_all_article()
    // {
    //     $article = Article::factory()->create();

    //     $response = $this->getJson(route("article.index"));
    //     $response->assertOk();

    //     $response->assertJson([
    //         "data" => [
    //             [
    //                 "id" => $article->id,
    //                 "title" => $article->title,
    //                 "content" => $article->content,
    //                 "image" => $article->image,
    //                 "category_id" => $article->category_id,
    //                 "user_id" => $article->user_id,
    //             ],
    //         ],
    //     ]);
    // }
}
