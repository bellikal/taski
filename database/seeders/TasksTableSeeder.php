<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Associative array of realistic titles and descriptions
        $tasks = [
            [
                'title' => 'Create a weekly cleaning schedule',
                'description' => 'Plan a weekly cleaning schedule for your living space, including tasks like vacuuming, dusting, and laundry.',
            ],
            [
                'title' => 'Project presentation preparation',
                'description' => 'Prepare for an upcoming project presentation by gathering data, creating visuals, and rehearsing your presentation.',
            ],
            [
                'title' => 'Family game night planning',
                'description' => 'Plan a fun family game night with board games, card games, and snacks for everyone to enjoy.',
            ],
            [
                'title' => 'Personal fitness routine development',
                'description' => 'Design a personalized fitness routine that aligns with your fitness goals and daily schedule.',
            ],
            [
                'title' => 'Budget review and financial planning',
                'description' => 'Review your monthly budget, track expenses, and create a financial plan for future savings and investments.',
            ],
            [
                'title' => 'Work project brainstorming',
                'description' => 'Host a brainstorming session with your colleagues to generate creative ideas for an upcoming project.',
            ],
            [
                'title' => 'Family outdoor adventure planning',
                'description' => 'Plan an exciting outdoor adventure for your family, such as a hiking trip, camping, or a visit to a nature reserve.',
            ],
            [
                'title' => 'Personal skill improvement',
                'description' => 'Identify a skill you want to improve and set specific goals and a practice plan to enhance it.',
            ],
            [
                'title' => 'Home organization project',
                'description' => 'Take on a home organization project to declutter and reorganize a specific area in your house.',
            ],
            [
                'title' => 'Work presentation practice',
                'description' => 'Practice and refine your presentation skills for an important work-related event or meeting.',
            ],
            [
                'title' => 'Family meal planning',
                'description' => 'Plan healthy and balanced meals for your family for the week, including grocery shopping and preparation.',
            ],
            [
                'title' => 'Personal journaling for self-reflection',
                'description' => 'Start a journal to reflect on your thoughts, emotions, and experiences to promote self-awareness and growth.',
            ],
            [
                'title' => 'Household chores delegation',
                'description' => 'Assign specific household chores to family members and create a chore chart for accountability.',
            ],
            [
                'title' => 'Work deadline management',
                'description' => 'Organize your work tasks, set priorities, and manage deadlines effectively to meet project goals.',
            ],
            [
                'title' => 'Quality family time',
                'description' => 'Plan quality family time without electronic devices, focusing on meaningful interactions and bonding.',
            ],
        ];

        // Delete existing records from the "tasks" table
        #DB::table('tasks')->delete();

        // Ensure categories are present
        $categories = Category::all();

        // Retrieve all users from the database
        $users = User::all();

        foreach ($tasks as $task) {
            // Randomly select a user
            $user = $users->random();
            // Randomly select a category
            $category = $categories->random();

            // Insert task into tasks table
            DB::table('tasks')->insert([
                'user_id' => $user->id,
                'title' => $task['title'],
                'description' => $task['description'],
                'priority' => ['low', 'medium', 'high'][rand(0, 2)],
                'status' => ['open', 'in_progress', 'completed'][rand(0, 2)],
                'due_date' => now()->addDays(rand(1, 30)),
                'category_id' => $category->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
