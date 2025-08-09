<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        

        Book::create([
            'title' => 'Atomic Habits',
            'image' => 'images/book1.jpg',
            'description' => 'An easy & proven way to build good habits and break bad ones by James Clear.',
            'rating' => 4.8,
            'reviews' => json_encode(['Life-changing!', 'Practical and actionable.'])
        ]);

        Book::create([
            'title' => 'Ikigai',
            'image' => 'images/book2.jpg',
            'description' => 'The Japanese secret to a long and happy life.',
            'rating' => 4.4,
            'reviews' => json_encode(['Beautifully written.', 'Full of wisdom.'])
        ]);

        Book::create([
            'title' => 'The Art of Thinking Clearly',
            'image' => 'images/book3.jpg',
            'description' => 'A book by Rolf Dobelli exploring common thinking errors.',
            'rating' => 4.1,
            'reviews' => json_encode(['Eye-opening.', 'Makes you rethink your decisions.'])
        ]);

        Book::create([
            'title' => 'Harry Potter',
            'image' => 'images/book4.jpg',
            'description' => 'A fantasy series by J.K. Rowling.',
            'rating' => 4.9,
            'reviews' => json_encode(['Magical!', 'An unforgettable journey.'])
        ]);

        Book::create([
            'title' => 'Programming the Universe',
            'image' => 'images/book5.jpg',
            'description' => 'Quantum computation and the universe as information by Seth Lloyd.',
            'rating' => 4.0,
            'reviews' => json_encode(['Fascinating read.', 'Complex but rewarding.'])
        ]);

        Book::create([
            'title' => 'Cognitive Psychology',
            'image' => 'images/book6.jpg',
            'description' => 'An introduction to cognitive psychology concepts.',
            'rating' => 4.3,
            'reviews' => json_encode(['Informative.', 'Well-structured.'])
        ]);

        Book::create([
            'title' => 'Tintin: The Adventure of Tintin ',
            'image' => 'images/book7.jpg',
            'description' => 'Tintin and his adventurous journey..',
            'rating' => 4.7,
            'reviews' => json_encode(['Fun and adventurous.', 'Classic Tintin.'])
        ]);
        Book::create([
            'title' => 'Tintin: The Black Island',
            'image' => 'images/book8.jpg',
            'description' => 'A Tintin comic adventure by Hergé.',
            'rating' => 4.7,
            'reviews' => json_encode(['Fun and adventurous.', 'Classic Tintin.'])
        ]);

        Book::create([
            'title' => 'Himu',
            'image' => 'images/book9.jpg',
            'description' => 'A popular fictional character created by Humayun Ahmed.',
            'rating' => 4.6,
            'reviews' => json_encode(['Captivating.', 'Unique character portrayal.'])
        ]);

        Book::create([
            'title' => 'Misir Ali',
            'image' => 'images/book10.jpg',
            'description' => 'Mystery series by Humayun Ahmed.',
            'rating' => 4.5,
            'reviews' => json_encode(['Intriguing mysteries.', 'Brilliant storytelling.'])
        ]);

        Book::create([
            'title' => 'Chander Pahar',
            'image' => 'images/book11.jpg',
            'description' => 'An adventure novel by Bibhutibhushan Bandyopadhyay.',
            'rating' => 4.8,
            'reviews' => json_encode(['Epic adventure!', 'Beautifully written.'])
        ]);
        Book::create([
            'title' => 'The Alchemist',
            'image' => 'images/book12.jpg',
            'description' => 'A journey of self-discovery by Paulo Coelho.',
            'rating' => 4.5,
            'reviews' => json_encode(['Inspiring!', 'A masterpiece!'])
        ]);

        Book::create([
            'title' => '1984',
            'image' => 'images/book13.jpg',
            'description' => 'Dystopian novel by George Orwell.',
            'rating' => 4.2,
            'reviews' => json_encode(['Terrifying and brilliant.', 'Timeless classic.'])
        ]);
        Book::create([
            'title' => 'To Kill a Mockingbird',
            'image' => 'images/book14.jpg',
            'description' => 'A novel by Harper Lee exploring themes of justice and morality.',
            'rating' => 4.7,
            'reviews' => json_encode(['Powerful message.', 'Beautifully written.'])
        ]);

        Book::create([
            'title' => 'Pride and Prejudice',
            'image' => 'images/book15.jpg',
            'description' => 'A romantic novel by Jane Austen.',
            'rating' => 4.6,
            'reviews' => json_encode(['Timeless classic.', 'Elegant prose.'])
        ]);
    }
}
