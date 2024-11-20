<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Route chính
Route::get('/', function () {
    return view('welcome');
});

// Route để thêm sinh viên (chỉ để phát triển)
Route::get('/add-students', [StudentController::class, 'addStudents'])->name('students.add'); 

// Route để tạo sinh viên
Route::get('/admin/student/create', [StudentController::class, 'create'])->name('student.create'); 
Route::post('/admin/student/store', [StudentController::class, 'store'])->name('student.store'); 

// Route để lấy danh sách sinh viên dưới dạng JSON
Route::get('students/json', [StudentController::class, 'getAllStudentsJson'])->name('student.json');

// Route để lấy sinh viên kèm khóa học
Route::get('students-with-courses', [StudentController::class, 'getStudentsWithCourses'])->name('students.courses');

// Route để hiển thị danh sách tất cả sinh viên
Route::get('/students', [StudentController::class, 'index'])->name('student.index'); 

// Route để hiển thị chi tiết sinh viên
Route::get('/students/{id}', [StudentController::class, 'show'])->name('student.show'); 

// Route để hiển thị form chỉnh sửa thông tin sinh viên
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('student.edit'); 

// Route để cập nhật thông tin sinh viên
Route::put('/students/{id}', [StudentController::class, 'update'])->name('student.update'); 

// Route để xóa sinh viên
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('student.destroy'); 
