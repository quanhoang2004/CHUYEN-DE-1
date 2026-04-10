@extends('layouts.master')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<div class="row">

    <!-- Tổng khóa học -->
    <div class="col-md-3">
        <div class="card bg-primary text-white p-3">
            <h5>Tổng khóa học</h5>
            <h3>{{ $totalCourses }}</h3>
        </div>
    </div>

    <!-- Tổng học viên -->
    <div class="col-md-3">
        <div class="card bg-success text-white p-3">
            <h5>Tổng học viên</h5>
            <h3>{{ $totalStudents }}</h3>
        </div>
    </div>

    <!-- Doanh thu -->
    <div class="col-md-3">
        <div class="card bg-warning text-white p-3">
            <h5>Doanh thu</h5>
            <h3>{{ number_format($totalRevenue) }} VND</h3>
        </div>
    </div>

    <!-- Top course -->
    <div class="col-md-3">
        <div class="card bg-danger text-white p-3">
            <h5>Top khóa học</h5>
            <h6>{{ $topCourse->name ?? 'N/A' }}</h6>
            <small>{{ $topCourse->enrollments_count ?? 0 }} học viên</small>
        </div>
    </div>

</div>

<hr>

<h4>5 khóa học mới</h4>

<table class="table table-bordered">
    <tr>
        <th>Tên</th>
        <th>Giá</th>
        <th>Trạng thái</th>
    </tr>

    @foreach($latestCourses as $course)
    <tr>
        <td>{{ $course->name }}</td>
        <td>{{ $course->price }}</td>
        <td>
            <span class="badge bg-info">{{ $course->status }}</span>
        </td>
    </tr>
    @endforeach
</table>

@endsection