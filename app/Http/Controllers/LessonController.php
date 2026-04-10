<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // 📌 Danh sách bài học (theo course)
    public function index(Request $request)
    {
        $course_id = $request->course_id;

        $lessons = Lesson::with('course')
            ->when($course_id, function ($query) use ($course_id) {
                $query->where('course_id', $course_id);
            })
            ->orderBy('order')
            ->paginate(5);

        $courses = Course::all();

        return view('lessons.index', compact('lessons', 'courses', 'course_id'));
    }

    // 📌 Form tạo
    public function create()
    {
        $courses = Course::all();
        return view('lessons.create', compact('courses'));
    }

    // 📌 Lưu
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required',
            'video_url' => 'nullable|url',
            'order' => 'required|integer|min:0'
        ]);

        Lesson::create($request->all());

        return redirect()->route('lessons.index')
            ->with('success', 'Thêm bài học thành công');
    }

    // 📌 Form edit
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $courses = Course::all();

        return view('lessons.edit', compact('lesson', 'courses'));
    }

    // 📌 Update
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required',
            'video_url' => 'nullable|url',
            'order' => 'required|integer|min:0'
        ]);

        $lesson->update($request->all());

        return redirect()->route('lessons.index')
            ->with('success', 'Cập nhật thành công');
    }

    // 📌 Xóa
    public function destroy($id)
    {
        Lesson::findOrFail($id)->delete();

        return back()->with('success', 'Đã xóa bài học');
    }
}