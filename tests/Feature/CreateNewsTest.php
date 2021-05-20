<?php

namespace Tests\Feature;

use App\Models\Category;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateNewsTest extends TestCase
{
    use RefreshDatabase; // лучше запускать на тестовой базе, т.к. каждый раз обновляет ее после теста
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_success()
    {
        /*
         * авторизоваться
         * отправить POST-запрос на создание новости
         * получить ответ, т.е. редирект на страничку новостей
         * */

        /* у нас нет проверки на пользователя - пока убираем
        $user = User::factory()->create();
        $this->actingAs($user); // тест действует от имени созданного юзера */
        $category = Category::factory()->create();
//        $response = $this->get('/');
        $newsData = [
            'name' => 'This is title',
            'description' => 'This is description',
            'category_id' => $category->id,
        ];

        // $this->expectException(); //
        $response = $this->post('/news/create', $newsData); // post имитирует request, не отправляет его на самом деле, под капотом нет вызова http-запроса

        $response->assertDatabaseHas('news', $newsData); // нет такого метода assertDatabaseHas()?
        $response->assertStatus(302);
//        $response->assertRedirect('/news'); // так не работает
        $response->assertRedirect('http://localhost'); // а так сработало
        $response->assertSessionDoesntHaveErrors();
    }

    public function test_invalid_form_without_title()
    {
        $category = Category::factory()->create();

        $response = $this->post('/news/create', [
            'description' => 'This is description',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(302); // не 422, а 302, т.к. редиректит
        $response->assertSessionHasErrors(['title']);
    }

    public function test_invalid_form_with_too_long_title()
    {
        $category = Category::factory()->create();

        $response = $this->post('/news/create', [
            'title' => 'asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf asdfadsf asf asdfa sdf asfd asfaf',
            'description' => 'This is description',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(302); // не 422, а 302, т.к. редиректит
//        $response->assertRedirect('/news/create');
        $response->assertRedirect('http://localhost');
        $response->assertSessionHasErrors(['title']);
    }
}
