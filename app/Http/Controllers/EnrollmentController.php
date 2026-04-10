<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // 📌 Danh sách đăng ký
    public function index(Request $request)
    {
        $course_id = $request->course_id;

        $enrollments = Enrollment::with('course', 'student')
            ->when($course_id, function ($query) use ($course_id) {
                $query->where('course_id', $course_id);
            })
            ->paginate(5);

        $courses = Course::all();

        // Tổng số học viên
        $totalStudents = Enrollment::count();

        return view('enrollments.index', compact(
            'enrollments',
            'courses',
            'course_id',
            'totalStudents'
        ));
    }

    // 📌 Form đăng ký
    public function create()
    {
        $courses = Course::all();
        return view('enrollments.create', compact('courses'));
    }

    // 📌 Lưu đăng ký
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required',
            'email' => 'required|email'
        ]);

        // Tìm hoặc tạo student
        $student = Student::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name]
        );

        // Tránh đăng ký trùng
        $exists = Enrollment::where('course_id', $request->course_id)
            ->where('student_id', $student->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Học viên đã đăng ký khóa này');
        }

        Enrollment::create([
            'course_id' => $request->course_id,
            'student_id' => $student->id
        ]);

        return redirect()->route('enrollments.index')
            ->with('success', 'Đăng ký thành công');
    }

    // 📌 Xóa đăng ký
    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();

        return back()->with('success', 'Đã xóa đăng ký');
    }
}