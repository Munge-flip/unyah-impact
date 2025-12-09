<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // ==================== GENSHIN IMPACT ====================
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

            // ==================== HONKAI STAR RAIL ====================
            // Maintenance
            ['game' => 'Honkai Star Rail', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Daily', 'slug' => 'daily', 'price' => 57, 'description' => 'Daily missions and stamina usage'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Weekly', 'slug' => 'weekly', 'price' => 300, 'description' => 'Weekly tasks and echo of war'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Monthly', 'slug' => 'monthly', 'price' => 1300, 'description' => 'Full month maintenance'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Full Patch (6 weeks)', 'slug' => 'full-patch', 'price' => 700, 'description' => 'Complete patch cycle'],

            // Regular Quests
            ['game' => 'Honkai Star Rail', 'category_name' => 'Regular Quests', 'category' => 'quests', 'name' => 'Short quests (1-2 parts)', 'slug' => 'short', 'price' => 60, 'description' => 'Quick missions'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Regular Quests', 'category' => 'quests', 'name' => 'Long quests (multiple parts, lots of dialogue/fighting)', 'slug' => 'long', 'price' => 170, 'description' => 'Extended story quests'],

            // Events
            ['game' => 'Honkai Star Rail', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Light events (untouched)', 'slug' => 'light', 'price' => 120, 'description' => 'Simple event'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Full event (untouched)', 'slug' => 'full', 'price' => 120, 'description' => 'Complete event'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Light events (halfway)', 'slug' => 'light-half', 'price' => 100, 'description' => 'Finish light event'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Full event (halfway)', 'slug' => 'full-half', 'price' => 200, 'description' => 'Finish full event'],

            // Endgame
            ['game' => 'Honkai Star Rail', 'category_name' => 'Endgame', 'category' => 'endgame', 'name' => 'Memory of Chaos', 'slug' => 'memory-chaos', 'price' => 120, 'description' => 'Complete Memory of Chaos floors'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Endgame', 'category' => 'endgame', 'name' => 'Pure Fiction', 'slug' => 'pure-fiction', 'price' => 120, 'description' => 'Complete Pure Fiction stages'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Endgame', 'category' => 'endgame', 'name' => 'Apocalyptic Shadow', 'slug' => 'apocalyptic', 'price' => 120, 'description' => 'Complete Apocalyptic Shadow'],

            // Simulated Universe
            ['game' => 'Honkai Star Rail', 'category_name' => 'Simulated Universe', 'category' => 'simulated-clear', 'name' => 'Basic Clear (1 World)', 'slug' => 'basic', 'price' => 200, 'description' => 'Complete one world'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Simulated Universe', 'category' => 'simulated-clear', 'name' => 'Full Clear (All Worlds)', 'slug' => 'full', 'price' => 1000, 'description' => 'Complete all worlds'],

            // Divergent Universe
            ['game' => 'Honkai Star Rail', 'category_name' => 'Divergent Universe', 'category' => 'divergent', 'name' => 'Basic Clear (1 Protocol)', 'slug' => 'basic', 'price' => 200, 'description' => 'Complete one protocol'],
            ['game' => 'Honkai Star Rail', 'category_name' => 'Divergent Universe', 'category' => 'divergent', 'name' => 'Full Clear (All Protocols)', 'slug' => 'full', 'price' => 1000, 'description' => 'Complete all protocols'],

            // 100% Area Completion
            ['game' => 'Honkai Star Rail', 'category_name' => '100% Area Completion', 'category' => 'completion', 'name' => 'Small area (ex. "Fallen Twilight City" Okhema)', 'slug' => 'small', 'price' => 170, 'description' => 'Complete small area'],
            ['game' => 'Honkai Star Rail', 'category_name' => '100% Area Completion', 'category' => 'completion', 'name' => 'Whole Map', 'slug' => 'whole', 'price' => 500, 'description' => 'Complete entire map'],

            // ==================== ZENLESS ZONE ZERO ====================
            // Maintenance
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Daily', 'slug' => 'daily', 'price' => 57, 'description' => 'Daily tasks and energy usage'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Weekly', 'slug' => 'weekly', 'price' => 300, 'description' => 'Weekly missions'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Monthly', 'slug' => 'monthly', 'price' => 1300, 'description' => 'Monthly upkeep'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Maintenance', 'category' => 'maintenance', 'name' => 'Full Patch (6 weeks)', 'slug' => 'full-patch', 'price' => 1700, 'description' => 'Full patch maintenance'],

            // Regular Quests
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Regular Quests', 'category' => 'quests', 'name' => 'Short quests (1-2 parts)', 'slug' => 'short', 'price' => 60, 'description' => 'Quick missions'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Regular Quests', 'category' => 'quests', 'name' => 'Long quests (multiple parts, lots of dialogue/fighting)', 'slug' => 'long', 'price' => 170, 'description' => 'Extended quests'],

            // Events
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Light events (untouched)', 'slug' => 'light', 'price' => 120, 'description' => 'Simple event'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Full event (untouched)', 'slug' => 'full', 'price' => 120, 'description' => 'Complete event'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Light events (halfway)', 'slug' => 'light-half', 'price' => 100, 'description' => 'Finish light event'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Events', 'category' => 'events', 'name' => 'Full event (halfway)', 'slug' => 'full-half', 'price' => 200, 'description' => 'Finish full event'],

            // Endgame
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Endgame', 'category' => 'endgame', 'name' => 'Shiyu Defense', 'slug' => 'shiyu-defense', 'price' => 150, 'description' => 'Complete Shiyu Defense'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Endgame', 'category' => 'endgame', 'name' => 'Deadly Assault', 'slug' => 'deadly-assault', 'price' => 150, 'description' => 'Complete Deadly Assault'],

            // Hollow Zero
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Hollow Zero', 'category' => 'hollow-zero', 'name' => '20 levels', 'slug' => '20-levels', 'price' => 200, 'description' => 'Complete 20 levels'],
            ['game' => 'Zenless Zone Zero', 'category_name' => 'Hollow Zero', 'category' => 'hollow-zero', 'name' => 'Full level', 'slug' => 'full-level', 'price' => 1000, 'description' => 'Complete all levels'],

            // 100% Area Completion
            ['game' => 'Zenless Zone Zero', 'category_name' => '100% Area Completion', 'category' => 'completion', 'name' => '1 Location (ex. Sixth Street)', 'slug' => 'one-location', 'price' => 170, 'description' => 'Complete one location'],
            ['game' => 'Zenless Zone Zero', 'category_name' => '100% Area Completion', 'category' => 'completion', 'name' => 'Whole Location', 'slug' => 'whole-location', 'price' => 500, 'description' => 'Complete entire location'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
