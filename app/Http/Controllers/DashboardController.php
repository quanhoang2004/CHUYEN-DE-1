<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng khóa học
        $totalCourses = Course::count();

        // Tổng học viên
        $totalStudents = Student::count();

        // Tổng doanh thu
        $totalRevenue = Course::sum('price');

        // Khóa học nhiều học viên nhất
        $topCourse = Course::withCount('enrollments')
            ->orderByDesc('enrollments_count')
            ->first();

        // 5 khóa học mới
        $latestCourses = Course::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalCourses',
            'totalStudents',
            'totalRevenue',
            'topCourse',
            'latestCourses'
        ));
    }
}