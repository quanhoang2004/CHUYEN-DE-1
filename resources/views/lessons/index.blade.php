@extends('layouts.master')

@section('content')

<h3>Quản lý bài học</h3>

<!-- FILTER THEO COURSE -->
<form method="GET" class="mb-3">
    <select name="course_id" class="form-control" onchange="this.form.submit()">
        <option value="">--Chọn khóa học--</option>
        @foreach($courses as $c)
            <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select>
</form>

<button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
    + Thêm bài học
</button>

<table class="table table-bordered">
    <tr>
        <th>Khóa học</th>
        <th>Tiêu đề</th>
        <th>Video</th>
        <th>Thứ tự</th>
        <th>Hành động</th>
    </tr>

    @foreach($lessons as $lesson)
    <tr>
        <td>{{ $lesson->course->name }}</td>
        <td>{{ $lesson->title }}</td>
        <td>{{ $lesson->video_url }}</td>
        <td>{{ $lesson->order }}</td>
        <td>
            <button class="btn btn-warning btn-sm"
                onclick="editLesson({{ $lesson }})">Sửa</button>

            <form action="{{ route('lessons.destroy',$lesson->id) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $lessons->links() }}

<!-- CREATE MODAL -->
<div class="modal fade" id="createModal">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('lessons.store') }}" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5>Thêm bài học</h5>
            </div>

            <div class="modal-body">

                <select name="course_id" class="form-control mb-2">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>

                <input type="text" name="title" class="form-control mb-2" placeholder="Tiêu đề">

                <input type="text" name="video_url" class="form-control mb-2" placeholder="Video URL">

                <input type="number" name="order" class="form-control" placeholder="Thứ tự">

            </div>

            <div class="modal-footer">
                <button class="btn btn-success">Lưu</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <form method="POST" id="editForm" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5>Sửa bài học</h5>
            </div>

            <div class="modal-body">

                <select name="course_id" id="edit_course" class="form-control mb-2">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>

                <input type="text" name="title" id="edit_title" class="form-control mb-2">

                <input type="text" name="video_url" id="edit_video" class="form-control mb-2">

                <input type="number" name="order" id="edit_order" class="form-control">

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>

@endsection

<script>
function editLesson(lesson) {
    document.getElementById('edit_title').value = lesson.title;
    document.getElementById('edit_video').value = lesson.video_url;
    document.getElementById('edit_order').value = lesson.order;
    document.getElementById('edit_course').value = lesson.course_id;

    document.getElementById('editForm').action = '/lessons/' + lesson.id;

    new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>