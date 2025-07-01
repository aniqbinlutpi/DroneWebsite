<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Drone Racing Basics with Block Programming',
                'slug' => 'drone-racing-basics-block-programming',
                'description' => 'Perfect introduction to drone racing for primary school students. Learn the fundamentals of block-based programming to control racing drones. Students will master basic flight patterns, safety protocols, and simple racing algorithms using drag-and-drop visual programming.',
                'short_description' => 'Learn drone racing basics using visual block programming',
                'price' => 89.99,
                'duration_hours' => 3,
                'max_participants' => 6,
                'skill_level' => 'beginner',
                'requirements' => json_encode([
                    'Age: 6-12 years',
                    'No prior programming experience required',
                    'Basic computer skills helpful'
                ]),
                'what_included' => json_encode([
                    'Educational drone for the session',
                    'Block programming software access',
                    'Safety equipment',
                    'Certificate of completion',
                    'Take-home programming guide'
                ]),
                'image' => 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Advanced Racing Algorithms & Speed Optimization',
                'slug' => 'advanced-racing-algorithms-speed-optimization',
                'description' => 'Advanced course focusing on programming the shortest racing paths and fastest flight algorithms. Students learn to optimize drone performance for competitive racing using advanced block programming techniques and mathematical concepts.',
                'short_description' => 'Master advanced algorithms for competitive racing speed',
                'price' => 149.99,
                'duration_hours' => 4,
                'max_participants' => 4,
                'skill_level' => 'advanced',
                'requirements' => json_encode([
                    'Age: 10-16 years',
                    'Completion of basic course or equivalent experience',
                    'Understanding of basic programming concepts'
                ]),
                'what_included' => json_encode([
                    'Advanced racing drone for the session',
                    'Professional programming software',
                    'Competition-grade equipment',
                    'Performance analytics tools',
                    'Advanced certificate'
                ]),
                'image' => 'https://images.unsplash.com/photo-1527977966376-1c8408f9f108?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Competition Preparation & Strategy',
                'slug' => 'competition-preparation-strategy',
                'description' => 'Intensive training for students preparing for official drone racing competitions. Covers advanced programming strategies, race tactics, equipment optimization, and mental preparation for tournaments.',
                'short_description' => 'Intensive training for drone racing competitions',
                'price' => 199.99,
                'duration_hours' => 6,
                'max_participants' => 3,
                'skill_level' => 'advanced',
                'requirements' => json_encode([
                    'Age: 12-18 years',
                    'Completion of advanced course',
                    'Own racing drone recommended',
                    'Competition experience preferred'
                ]),
                'what_included' => json_encode([
                    'Professional racing drone access',
                    'Competition simulation software',
                    'Strategy development tools',
                    'Mental preparation sessions',
                    'Competition entry guidance'
                ]),
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Intermediate Flight Control & Navigation',
                'slug' => 'intermediate-flight-control-navigation',
                'description' => 'Build upon basic skills with intermediate programming concepts. Students learn complex flight patterns, obstacle navigation, and automated racing sequences using block programming.',
                'short_description' => 'Intermediate programming for complex flight patterns',
                'price' => 119.99,
                'duration_hours' => 4,
                'max_participants' => 5,
                'skill_level' => 'intermediate',
                'requirements' => json_encode([
                    'Age: 8-14 years',
                    'Completion of basic course',
                    'Understanding of basic flight controls'
                ]),
                'what_included' => json_encode([
                    'Intermediate racing drone',
                    'Navigation programming tools',
                    'Obstacle course access',
                    'Progress tracking system',
                    'Intermediate certificate'
                ]),
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Team Racing & Collaborative Programming',
                'slug' => 'team-racing-collaborative-programming',
                'description' => 'Learn to work in teams to program coordinated drone racing strategies. Perfect for developing teamwork skills while mastering advanced programming concepts for multi-drone racing scenarios.',
                'short_description' => 'Team-based programming for coordinated racing',
                'price' => 159.99,
                'duration_hours' => 5,
                'max_participants' => 6,
                'skill_level' => 'intermediate',
                'requirements' => json_encode([
                    'Age: 9-15 years',
                    'Intermediate programming skills',
                    'Good communication skills',
                    'Team collaboration experience preferred'
                ]),
                'what_included' => json_encode([
                    'Multiple racing drones for team use',
                    'Collaborative programming platform',
                    'Team communication tools',
                    'Group project materials',
                    'Team achievement certificates'
                ]),
                'image' => 'https://images.unsplash.com/photo-1551808525-51a94da548ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'STEM Integration: Math & Physics in Racing',
                'slug' => 'stem-integration-math-physics-racing',
                'description' => 'Educational course integrating mathematics and physics concepts with drone racing. Students learn about velocity, acceleration, trajectory calculations, and apply these concepts through block programming.',
                'short_description' => 'Learn math and physics through drone racing programming',
                'price' => 129.99,
                'duration_hours' => 4,
                'max_participants' => 5,
                'skill_level' => 'intermediate',
                'requirements' => json_encode([
                    'Age: 10-16 years',
                    'Basic math skills (algebra helpful)',
                    'Interest in science and physics',
                    'Basic programming knowledge'
                ]),
                'what_included' => json_encode([
                    'Educational racing drone',
                    'STEM calculation tools',
                    'Physics simulation software',
                    'Mathematical programming exercises',
                    'STEM achievement certificate'
                ]),
                'image' => 'https://images.unsplash.com/photo-1473968512647-3e447244af8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
