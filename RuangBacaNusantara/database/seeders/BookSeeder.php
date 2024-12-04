<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'The Power of Habit',
            'author' => 'Charles Duhigg',
            'ISBN' => '978-1234567881',
            'publisher' => 'Random House',
            'language' => 'English',
            'year_of_publication' => 2012,
            'description' => 'A book that explores the science of habits and how to change them.',
            'category' => 'Self Help',
            'quantity' => 5,
            'image' => 'https://images.app.goo.gl/6YaxsFH9XbEK4Gjo7',
        ]);

        Book::create([
            'title' => 'Seni Bodoh Amat',
            'author' => 'Mark Manson',
            'ISBN' => '978-1234567890',
            'publisher' => 'Publisher Name',
            'language' => 'Indonesian',
            'year_of_publication' => 2023,
            'description' => 'A book about not caring and being yourself.',
            'category' => 'Self Help',
            'quantity' => 10,
            'image' => 'https://images.app.goo.gl/hn6EkUs5WahBgsNa6',
        ]);

        Book::create([
            'title' => 'Atomic Habits',
            'author' => 'James Clear',
            'ISBN' => '978-0735211292',
            'publisher' => 'Penguin Random House',
            'language' => 'English',
            'year_of_publication' => 2018,
            'description' => 'A book that shows how small habits can lead to big changes.',
            'category' => 'Self Help',
            'quantity' => 7,
            'image' => 'https://images.app.goo.gl/FZRXvHYhEezAnMEa9',
        ]);


    }
}
