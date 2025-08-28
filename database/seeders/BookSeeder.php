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
            'author' => 'James Clear',
            'image' => 'images/book1.jpg',
            'description' => 'An easy & proven way to build good habits and break bad ones by James Clear.',
            'rating' => 4.8,
            'reviews' => json_encode(['Life-changing!', 'Practical and actionable.']),
            'price' => 300
        ]);

        Book::create([
            'title' => 'Ikigai',
            'author' => 'Héctor García and Francesc Miralles',
            'image' => 'images/book2.jpg',
            'description' => 'The Japanese secret to a long and happy life.',
            'rating' => 4.4,
            'reviews' => json_encode(['Beautifully written.', 'Full of wisdom.']),
            'price' => 350
        ]);

        Book::create([
            'title' => 'The Art of Thinking Clearly',
            'author' => 'Rolf Dobelli',
            'image' => 'images/book3.jpg',
            'description' => 'A book by Rolf Dobelli exploring common thinking errors.',
            'rating' => 4.1,
            'reviews' => json_encode(['Eye-opening.', 'Makes you rethink your decisions.']),
            'price' => 330
        ]);

        Book::create([
            'title' => 'Harry Potter',
            'author' => 'J.K. Rowling',
            'image' => 'images/book4.jpg',
            'description' => 'A fantasy series by J.K. Rowling.',
            'rating' => 4.9,
            'reviews' => json_encode(['Magical!', 'An unforgettable journey.']),
            'price' => 700
        ]);

        Book::create([
            'title' => 'Programming the Universe',
            'author' => 'Seth Lloyd',
            'image' => 'images/book5.jpg',
            'description' => 'Quantum computation and the universe as information by Seth Lloyd.',
            'rating' => 4.0,
            'reviews' => json_encode(['Fascinating read.', 'Complex but rewarding.']),
            'price' => 220
        ]);

        Book::create([
            'title' => 'Cognitive Psychology',
            'author' => 'Various Authors',
            'image' => 'images/book6.jpg',
            'description' => 'An introduction to cognitive psychology concepts.',
            'rating' => 4.3,
            'reviews' => json_encode(['Informative.', 'Well-structured.']),
            'price' => 250
        ]);

        Book::create([
            'title' => 'Tintin: The Adventure of Tintin ',
            'author' => 'Hergé',
            'image' => 'images/book7.jpg',
            'description' => 'Tintin and his adventurous journey..',
            'rating' => 4.7,
            'reviews' => json_encode(['Fun and adventurous.', 'Classic Tintin.']),
            'price' => 400
        ]);
        Book::create([
            'title' => 'Tintin: The Black Island',
            'author' => 'Hergé',
            'image' => 'images/book8.jpg',
            'description' => 'A Tintin comic adventure by Hergé.',
            'rating' => 4.7,
            'reviews' => json_encode(['Fun and adventurous.', 'Classic Tintin.']),
            'price' => 300
        ]);

        Book::create([
            'title' => 'Himu',
            'author' => 'Humayun Ahmed',
            'image' => 'images/book9.jpg',
            'description' => 'A popular fictional character created by Humayun Ahmed.',
            'rating' => 4.6,
            'reviews' => json_encode(['Captivating.', 'Unique character portrayal.']),
            'price' => 150
        ]);

        Book::create([
            'title' => 'Misir Ali',
            'author' => 'Humayun Ahmed',
            'image' => 'images/book10.jpg',
            'description' => 'Mystery series by Humayun Ahmed.',
            'rating' => 4.5,
            'reviews' => json_encode(['Intriguing mysteries.', 'Brilliant storytelling.']),
            'price' => 380
        ]);

        Book::create([
            'title' => 'The Alchemist',
            'author' => 'Paulo Coelho',
            'image' => 'images/book11.jpg',
            'description' => 'A novel by Paulo Coelho about a young Andalusian shepherd.',
            'rating' => 4.6,
            'reviews' => json_encode(['Inspiring.', 'A journey of self-discovery.']),
            'price' => 280
        ]);

        Book::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'image' => 'images/book12.jpg',
            'description' => 'A dystopian novel by George Orwell.',
            'rating' => 4.7,
            'reviews' => json_encode(['Thought-provoking.', 'A classic dystopian novel.']),
            'price' => 320
        ]);

        Book::create([
            'title' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'image' => 'images/book13.jpg',
            'description' => 'A novel by Harper Lee about racial injustice.',
            'rating' => 4.8,
            'reviews' => json_encode(['Powerful story.', 'Important themes.']),
            'price' => 290
        ]);

        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'image' => 'images/book14.jpg',
            'description' => 'A novel by F. Scott Fitzgerald about the American Dream.',
            'rating' => 4.5,
            'reviews' => json_encode(['Beautiful prose.', 'Timeless classic.']),
            'price' => 310
        ]);

        Book::create([
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'image' => 'images/book15.jpg',
            'description' => 'A romantic novel by Jane Austen.',
            'rating' => 4.6,
            'reviews' => json_encode(['Witty and charming.', 'Classic romance.']),
            'price' => 270
        ]);
    }
}
