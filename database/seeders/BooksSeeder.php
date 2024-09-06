<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology', 'Science', 'Adventure', 'History', 'Nature', 'Cooking',
            'Fantasy', 'Self-Help', 'Architecture', 'Gardening', 'Military', 'Psychology',
            'Space', 'Literature', 'Health', 'Business', 'Photography', 'Art'
        ];

        $categoryIds = [];
        foreach ($categories as $categoryName) {
            $category = Category::firstOrCreate(['name' => $categoryName]);
            $categoryIds[$categoryName] = $category->id;
        }

        $authors = [
            'Alice Johnson', 'Bob Smith', 'Carol White', 'David Brown', 'Ella Green',
            'Frank Black', 'Grace Adams', 'Hannah Wilson', 'Ian Carter', 'Jackie Miller',
            'Katherine Davis', 'Louis Anderson', 'Mia Thomas', 'Nina Clark', 'Olivia Lewis',
            'Paul Walker', 'Quinn Roberts', 'Rachel Green', 'Samuel King', 'Tina Lee',
            'Uma Patel', 'Victor Young', 'Wendy Adams', 'Xander Scott', 'Yara Garcia', 'Zane Wilson'
        ];

        $authorIds = [];
        foreach ($authors as $authorName) {
            $author = Author::firstOrCreate(['name' => $authorName]);
            $authorIds[$authorName] = $author->id;
        }

        $booksData = [
            [
                'title' => 'The Future of AI',
                'description' => 'A deep dive into artificial intelligence and its potential.',
                'price' => 29.99,
                'category' => 'Technology',
                'authors' => ['Alice Johnson', 'Bob Smith']
            ],
            [
                'title' => 'The Quantum Realm',
                'description' => 'Exploring the mysteries of quantum physics.',
                'price' => 24.99,
                'category' => 'Science',
                'authors' => ['Carol White']
            ],
            [
                'title' => 'The Lost City',
                'description' => 'An adventure through a forgotten civilization.',
                'price' => 19.99,
                'category' => 'Adventure',
                'authors' => ['David Brown', 'Ella Green']
            ],
            [
                'title' => 'Modern Gardening Techniques',
                'description' => 'Innovative methods for growing plants in the modern world.',
                'price' => 21.00,
                'category' => 'Gardening',
                'authors' => ['Grace Adams']
            ],
            [
                'title' => 'The Art of Cooking',
                'description' => 'A guide to mastering the culinary arts.',
                'price' => 25.50,
                'category' => 'Cooking',
                'authors' => ['Frank Black']
            ],
            [
                'title' => 'Architectural Wonders',
                'description' => 'A visual tour of the world’s most remarkable buildings.',
                'price' => 30.00,
                'category' => 'Architecture',
                'authors' => ['Ian Carter']
            ],
            [
                'title' => 'Space Exploration 101',
                'description' => 'An introductory guide to the universe beyond our planet.',
                'price' => 28.75,
                'category' => 'Space',
                'authors' => ['Rachel Green', 'Paul Walker']
            ],
            [
                'title' => 'Psychology of Everyday Life',
                'description' => 'Understanding human behavior in daily situations.',
                'price' => 22.99,
                'category' => 'Psychology',
                'authors' => ['Mia Thomas']
            ],
            [
                'title' => 'The Future of Photography',
                'description' => 'Techniques and tips for contemporary photography.',
                'price' => 29.00,
                'category' => 'Photography',
                'authors' => ['Yara Garcia']
            ],
            [
                'title' => 'The Evolution of Art',
                'description' => 'Tracing the development of art throughout history.',
                'price' => 31.50,
                'category' => 'Art',
                'authors' => ['Zane Wilson']
            ]
        ];

        foreach ($booksData as $data) {
            $categoryId = $categoryIds[$data['category']];

            $book = Book::updateOrCreate(
                ['title' => $data['title']],
                [
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'category_id' => $categoryId
                ]
            );

            $authorIdsList = [];
            foreach ($data['authors'] as $authorName) {
                if (isset($authorIds[$authorName])) {
                    $authorIdsList[] = $authorIds[$authorName];
                }
            }

            foreach ($authorIdsList as $authorId) {
                DB::table('book_author')->insert([
                    'book_id' => $book->id,
                    'author_id' => $authorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
