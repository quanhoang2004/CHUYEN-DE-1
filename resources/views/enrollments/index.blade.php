@extends('layouts.master')

@section('content')

<h3>Quản lý đăng ký học</h3>

<h5 class="mb-3">Tổng học viên: {{ $totalStudents }}</h5>

<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
    + Đăng ký học
</button>

<table class="table table-bordered">
    <tr>
        <th>Tên</th>
        <th>Email</th>
        <th>Khóa học</th>
        <th>Hành động</th>
    </tr>

    @foreach($enrollments as $enroll)
    <tr>
        <td>{{ $enroll->student->name }}</td>
        <td>{{ $enroll->student->email }}</td>
        <td>{{ $enroll->course->name }}</td>
        <td>
            <form action="{{ route('enrollments.destroy',$enroll->id) }}" method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $enrollments->links() }}

<!-- CREATE MODAL -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('enrollments.store') }}" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Đăng ký học</h5>
            </div>

            <div class="modal-body">

                <select name="course_id" class="form-control mb-2">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>

                <input type="text" name="name" class="form-control mb-2" placeholder="Tên học viên">

                <input type="email" name="email" class="form-control" placeholder="Email">

            </div>

            <div class="modal-footer">
                <button class="btn btn-success">Đăng ký</button>
            </div>
        </form>
    </div>
</div>

@endsection