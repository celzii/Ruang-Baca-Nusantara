<?php
// tests/Feature/BookTest.php
namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_book_creation()
    {
        $response = $this->post('/admin/books', [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'ISBN' => '1234567890123',
            'publisher' => 'Test Publisher',
            'language' => 'English',
            'year_of_publication' => 2020,
            'category' => 'Test Category',
            'quantity' => 10,
        ]);

        $response->assertStatus(302); // Harus berhasil dan redirect
        $this->assertDatabaseHas('books', [
            'title' => 'Test Book',
            'author' => 'Test Author',
        ]);
    }
}
