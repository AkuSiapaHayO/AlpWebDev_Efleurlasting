<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Doesn't have the correct description.
        Category::create([
            'category_name' => 'Classic Bouquet',
            'description' => 'Elevate timeless elegance with our Classic Bouquet collection. Immerse yourself in the charm of artificial roses meticulously arranged to capture the essence of everlasting beauty. Each petal is a testament to the artistry behind this bouquet, making it an ideal choice for those who appreciate the enduring allure of classic florals.'
        ]);

        Category::create([
            'category_name' => 'Mix Bouquet',
            'description' => "Unleash a burst of colors and textures with our Mix Bouquet collection. This curated ensemble of artificial flowers combines a variety of blooms, creating a harmonious medley of nature's finest. Perfect for those who seek a vibrant and dynamic arrangement, the Mix Bouquet is a celebration of diversity and creativity."
        ]);

        Category::create([
            'category_name' => 'Graduation Bouquet',
            'description' => 'Commemorate academic achievements with our Graduation Bouquet collection. Crafted to symbolize growth, accomplishment, and new beginnings, this artificial flower bouquet is a thoughtful gift for graduates. Let the beauty of each bloom mirror the blossoming success of those stepping into a new chapter of life.'
        ]);

        Category::create([
            'category_name' => 'Bloom Box',
            'description' => "Experience the art of gifting with our Bloom Box collection. Nestled within an elegant box, this artificial flower bouquet exudes sophistication and charm. Whether it's a special occasion or a heartfelt gesture, the Bloom Box is a captivating choice, presenting the beauty of everlasting blooms in a delightful package."
        ]);

        Category::create([
            'category_name' => 'Balloon Series',
            'description' => "Infuse joy and playfulness into your celebrations with our Balloon Series. This collection pairs the whimsy of balloons with the elegance of artificial flowers, creating a delightful fusion of fun and sophistication. Perfect for birthdays, parties, or any occasion that calls for a touch of exuberance."
        ]);

        Category::create([
            'category_name' => 'Gift Series',
            'description' => "Elevate the art of gifting with our Gift Series. Each artificial flower gift set is thoughtfully curated to convey emotions, whether it's love, appreciation, or congratulations. Transform ordinary moments into extraordinary memories with these meticulously crafted arrangements, designed to be the perfect expression of your sentiments."
        ]);

        Category::create([
            'category_name' => 'Premium Collection',
            'description' => 'Indulge in opulence with our Premium Collection. This assortment of artificial flowers represents the epitome of luxury and sophistication. From exquisite arrangements to premium blooms, this collection is tailored for those who seek the finest in artificial floral design. Elevate your space with the timeless beauty of our Premium Collection.'
        ]);
    }
}
