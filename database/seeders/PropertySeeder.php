<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@renthub.com',
            'phone' => '+256700000000',
        ]);

        // Create sample landlords
        $landlords = User::factory()->landlord()->count(5)->create();

        // Create sample tenants
        $tenants = User::factory()->tenant()->count(10)->create();

        // Create sample properties for each landlord
        foreach ($landlords as $landlord) {
            Property::factory()
                ->count(rand(2, 6))
                ->for($landlord, 'user')
                ->create();
        }

        // Create some specific sample properties with more details
        $specificProperties = [
            [
                'title' => 'Luxury 3-bedroom apartment in Kololo',
                'description' => 'Beautiful modern apartment with stunning views of Kampala. Features include 3 spacious bedrooms, 2 bathrooms, a fully equipped kitchen, living room, dining area, and a balcony. Located in the prestigious Kololo neighborhood with easy access to shopping centers, restaurants, and business district.',
                'price' => 1500000,
                'location' => 'Kololo',
                'rooms' => 3,
                'status' => 'approved',
            ],
            [
                'title' => 'Affordable single room in Banda',
                'description' => 'Perfect for students and young professionals. Self-contained single room with private bathroom and kitchenette. Located in a quiet neighborhood with good transport links to Makerere University and Kampala city center.',
                'price' => 300000,
                'location' => 'Banda',
                'rooms' => 1,
                'status' => 'approved',
            ],
            [
                'title' => 'Spacious family home in Ntinda',
                'description' => 'Beautiful 4-bedroom house perfect for families. Features include a large compound, parking space, modern kitchen, living and dining areas. Located in the secure and family-friendly Ntinda neighborhood with schools and hospitals nearby.',
                'price' => 2000000,
                'location' => 'Ntinda',
                'rooms' => 4,
                'status' => 'approved',
            ],
            [
                'title' => 'Modern studio apartment in Bugolobi',
                'description' => 'Contemporary studio apartment ideal for young professionals. Open-plan living with modern fixtures, high-speed internet ready, and 24/7 security. Walking distance to Bugolobi market and various amenities.',
                'price' => 800000,
                'location' => 'Bugolobi',
                'rooms' => 1,
                'status' => 'approved',
            ],
            [
                'title' => 'Cozy 2-bedroom house in Kansanga',
                'description' => 'Charming 2-bedroom house with a small garden. Perfect for couples or small families. Features include a modern kitchen, living room, and secure parking. Close to Ggaba road with easy access to city center.',
                'price' => 900000,
                'location' => 'Kansanga',
                'rooms' => 2,
                'status' => 'pending',
            ],
        ];

        foreach ($specificProperties as $propertyData) {
            Property::factory()
                ->for($landlords->random(), 'user')
                ->create($propertyData);
        }
    }
}
