<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // 📌 Danh sách khóa học
    public function index(Request $request)
    {
        $query = Course::with('lessons', 'enrollments')
            ->withCount('lessons');

        // Search nâng cao
        if ($request->name) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->min_price && $request->max_price) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Sort
        if ($request->sort == 'price') {
            $query->orderBy('price');
        }

        if ($request->sort == 'latest') {
            $query->latest();
        }

        $courses = $query->paginate(5);

        return view('courses.index', compact('courses'));
    }

    // 📌 Form tạo
    public function create()
    {
        return view('courses.create');
    }

    // 📌 Lưu khóa học
    public function store(CourseRequest $request)
    {
        $data = $request->validated();

        // Tạo slug
        $data['slug'] = Str::slug($request->name);

        // Upload ảnh
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Thêm khóa học thành công');
    }

    // 📌 Form edit
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    // 📌 Update
    public function update(CourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);

        $data = $request->validated();

        // Update slug
        $data['slug'] = Str::slug($request->name);

        // Upload ảnh mới
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('courses.index')
            ->with('success', 'Cập nhật thành công');
    }

    // 📌 Xóa mềm
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return back()->with('success', 'Đã xóa');
    }

    // 📌 Khôi phục (custom)
    public function restore($id)
    {
        Course::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Đã khôi phục');
    }
}