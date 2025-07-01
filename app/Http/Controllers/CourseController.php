<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index(): View
    {
        $courses = Course::where('is_active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('skill_level')
            ->get();

        return view('courses.index', compact('courses'));
    }

    /**
     * Display the specified course
     */
    public function show($slug): View
    {
        $course = Course::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('courses.show', compact('course'));
    }

    /**
     * Show courses by skill level
     */
    public function skillLevel($level): View
    {
        $validLevels = ['beginner', 'intermediate', 'advanced'];
        
        if (!in_array($level, $validLevels)) {
            abort(404);
        }

        $courses = Course::where('skill_level', $level)
            ->where('is_active', true)
            ->orderBy('featured', 'desc')
            ->get();

        return view('courses.skill-level', compact('courses', 'level'));
    }
}
