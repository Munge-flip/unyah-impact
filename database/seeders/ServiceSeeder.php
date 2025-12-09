<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // Maintenance
            ['game' => 'Genshin Impact', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Daily', 'slug' => 'daily', 'price' => 57],
            ['game' => 'Genshin Impact', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Weekly', 'slug' => 'weekly', 'price' => 300],
            ['game' => 'Genshin Impact', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Monthly', 'slug' => 'monthly', 'price' => 1300],
            ['game' => 'Genshin Impact', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Full Patch (6 weeks)', 'slug' => 'full-patch', 'price' => 700],

            // Regular Quests
            ['game' => 'Genshin Impact', 'category_name' => 'Regular Quests', 'category' => 'quests', 'name' => 'Short quests (1-2 parts)', 'slug' => 'short', 'price' => 50],
            ['game' => 'Genshin Impact', 'category_name' => 'Regular Quests', 'category' => 'quests', 'name' => 'Long quests (multiple parts)', 'slug' => 'long', 'price' => 170],

            // Events
            ['game' => 'Genshin Impact', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Light events', 'slug' => 'light', 'price' => 120],
            ['game' => 'Genshin Impact', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Full event', 'slug' => 'full', 'price' => 120],
            ['game' => 'Genshin Impact', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Light events (Half)', 'slug' => 'light-half', 'price' => 100],
            ['game' => 'Genshin Impact', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Full event (Half)', 'slug' => 'full-half', 'price' => 200],

            // Endgame
            ['game' => 'Genshin Impact', 'category_name' => 'Endgame', 'category' => 'endgame', 'name' => 'Spiral abyss', 'slug' => 'spiral', 'price' => 120],
            ['game' => 'Genshin Impact', 'category_name' => 'Endgame', 'category' => 'endgame', 'name' => 'Imaginarium Theater', 'slug' => 'imaginarium', 'price' => 120],
            ['game' => 'Genshin Impact', 'category_name' => 'Endgame', 'category' => 'endgame', 'name' => 'Stygian Onslaught', 'slug' => 'stygian', 'price' => 120],

            // Waypoints
            ['game' => 'Genshin Impact', 'category_name' => 'Unlocking Waypoints & Statues', 'category' => 'waypoints', 'name' => 'Small Area', 'slug' => 'small', 'price' => 70],
            ['game' => 'Genshin Impact', 'category_name' => 'Unlocking Waypoints & Statues', 'category' => 'waypoints', 'name' => 'Full Region', 'slug' => 'full', 'price' => 70],

            // Chests
            ['game' => 'Genshin Impact', 'category_name' => 'Chest Farming', 'category' => 'chest', 'name' => 'Light farming (30 chests)', 'slug' => 'light', 'price' => 120],
            ['game' => 'Genshin Impact', 'category_name' => 'Chest Farming', 'category' => 'chest', 'name' => 'Full chest run', 'slug' => 'full', 'price' => 120],

            // Oculi
            ['game' => 'Genshin Impact', 'category_name' => 'Collecting oculi', 'category' => 'oculi', 'name' => '1 Region', 'slug' => 'one', 'price' => 170],
            ['game' => 'Genshin Impact', 'category_name' => 'Collecting oculi', 'category' => 'oculi', 'name' => 'Full map(all available oculi)', 'slug' => 'full', 'price' => 120],

            // Completion
            ['game' => 'Genshin Impact', 'category_name' => '100% Area Completion', 'category' => 'completion', 'name' => 'Small area', 'slug' => 'small', 'price' => 170],
            ['game' => 'Genshin Impact', 'category_name' => '100% Area Completion', 'category' => 'completion', 'name' => 'Whole region', 'slug' => 'whole', 'price' => 120],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}