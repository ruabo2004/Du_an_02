@extends('layouts.app') <!-- Sử dụng layout của bạn -->

@section('title', 'Chi tiết sinh viên')

@section('content')
    <h1>Chi tiết thông tin sinh viên</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $student->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $student->email }}</p>
            <p class="card-text"><strong>Ngày sinh:</strong> {{ $student->date_of_birth }}</p>
        </div>
    </div>

    <a href="{{ route('student.index') }}" class="btn btn-primary mt-3">Quay lại danh sách sinh viên</a>
@endsection
