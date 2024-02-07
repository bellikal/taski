<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
use App\Models\User;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::all();
        $users = User::all();

        foreach ($tasks as $task) {
            // Randomly generate the number of comments between 1 and 5
            $commentCount = rand(1, 5);

            for ($i = 0; $i < $commentCount; $i++) {
                // Generate random comment content
                $content = $this->generateCommentContent();
                // Randomly select a user
                $randomUser = $users->random();

                // Insert comment into comments table
                DB::table('comments')->insert([
                    'content' => $content,
                    'task_id' => $task->id,
                    'user_id' => $randomUser->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    // Generate random comment content
    private function generateCommentContent(): string
    {
        $comments = [
            // Motivational and Demotivational comments :-)
            "You are making great progress!",
            "Believe in yourself, you can do it!",
            "Your work is inspiring!",
            "Keep going, you are on the right track!",
            "You're doing an excellent job!",
            "That will never work.",
            "Give up, it's hopeless.",
            "You're wasting your time.",
            "It's pointless.",
            "You will never make it.",
            "You can achieve anything you want!",
            "Stay committed and don't get discouraged.",
            "Success is a journey, not a destination.",
            "Setbacks are part of the path to success.",
            "Every day is a new opportunity.",
            "Life rewards those who work hard.",
            "The only limit is the one you set for yourself.",
            "Set clear goals and pursue them relentlessly.",
            "Great dreams begin with small steps.",
            "You can accomplish anything if you believe in it.",
            "Obstacles are opportunities in disguise.",
            "Believe in your strengths, not your weaknesses.",
            "The best time to start is now.",
            "Success requires persistence and patience.",
            "Act with determination and resolve.",
            "Your potential is limitless.",
            "Stay focused and stay positive.",
            "You are stronger than you think.",
            "Don't let doubts overwhelm you.",
            "Every day is a chance for improvement.",
            "The future belongs to those who believe in the beauty of their dreams.",
            "Never give up, no matter how tough it gets.",
            "Stay motivated and chase your goals.",
            "Life rewards those who work hard and never give up.",
            "Be brave and believe in yourself.",
            "Every day is a new beginning.",
            "Success comes to those who never give up."
        ];

        $randomIndex = array_rand($comments);

        return $comments[$randomIndex];
    }
}
