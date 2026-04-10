@extends('layouts.master')

@section('content')

<h3>Quản lý khóa học</h3>

<!-- SEARCH + FILTER -->
<form method="GET" class="row mb-3">
    <div class="col">
        <input name="name" class="form-control" placeholder="Tên khóa học">
    </div>

    <div class="col">
        <select name="status" class="form-control">
            <option value="">--Trạng thái--</option>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="col">
        <input name="min_price" class="form-control" placeholder="Giá min">
    </div>

    <div class="col">
        <input name="max_price" class="form-control" placeholder="Giá max">
    </div>

    <div class="col">
        <button class="btn btn-primary">Tìm</button>
    </div>
</form>

<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
    + Thêm khóa học
</button>

<table class="table table-bordered">
    <tr>
        <th>Tên</th>
        <th>Giá</th>
        <th>Trạng thái</th>
        <th>Số bài</th>
        <th>Ảnh</th>
        <th>Hành động</th>
    </tr>

    @foreach($courses as $course)
    <tr>
        <td>{{ $course->name }}</td>
        <td>{{ $course->price }}</td>

        <td>
            <x-badge :status="$course->status" />
        </td>

        <td>{{ $course->lessons_count }}</td>

        <td>
            @if($course->image)
                <img src="{{ asset('storage/'.$course->image) }}" width="60">
            @endif
        </td>

        <td>
            <button class="btn btn-warning btn-sm"
                onclick="editCourse({{ $course }})">Sửa</button>

            <form action="{{ route('courses.destroy',$course->id) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Xóa</button>
            </form>

            <!-- RESTORE -->
            @if($course->deleted_at)
                <a href="{{ route('courses.restore',$course->id) }}" class="btn btn-info btn-sm">
                    Khôi phục
                </a>
            @endif
        </td>
    </tr>
    @endforeach
</table>

{{ $courses->links() }}

@endsection