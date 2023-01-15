<?php

namespace Tests\Feature;

use App\Models\Books;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BookTest extends TestCase
{
    use WithFaker;

    protected $user;
    protected $baseUrl = '/api/book/';
    protected function getAuth()
    {
        $user = User::find(1);
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        
        return $response;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->getAuth();
    }


    /**
     * Get all books
     *
     * @return void
     */
    public function test_get_all_list()
    {
        $response = $this->withHeaders(['Authorization'=>'Bearer '. $this->user['bearer_token']])->get($this->baseUrl);
        
        $response->assertStatus(200);
    }

    /**
     * Add book
     *
     * @return void
     */
    public function test_add_book()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $array = [
            'title' => $this->faker->word,
            'sub_title' => $this->faker->word,
            'author' => $this->faker->word,
            'price' => 12.5,
            'image' => $file
        ];

        $response = $this->withHeaders(['Authorization'=>'Bearer '. $this->user['bearer_token']])
                    ->post($this->baseUrl, $array);
        
        $response->assertStatus(200);
    }

    /**
     * Update book
     *
     * @return void
     */
    public function test_update_book()
    {

        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $array = [
            'title' => $this->faker->word,
            'sub_title' => $this->faker->word,
            'author' => $this->faker->word,
            'price' => 12.5,
            'image' => $file
        ];

        $books = Books::latest()->first();
        
        $response = $this->withHeaders(['Authorization'=>'Bearer '. $this->user['bearer_token']])
                    ->patch($this->baseUrl . $books->getKey(), $array);
                    
        $response->assertStatus(200);
    }

    /**
     * Delete book
     *
     * @return void
     */
    public function test_delete_book()
    {

        $books = Books::latest()->first();
        
        $response = $this->withHeaders(['Authorization'=>'Bearer '. $this->user['bearer_token']])
                    ->delete($this->baseUrl . $books->getKey());
                    
        $response->assertStatus(200);
    }
}
