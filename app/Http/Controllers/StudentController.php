<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function addStudents()
    {
        // Tạo dữ liệu sinh viên khác nhau
        $students = [
            ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'date_of_birth' => '2000-01-01'],
            ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'date_of_birth' => '2001-02-02'],
            ['name' => 'Alice Johnson', 'email' => 'alice.johnson@example.com', 'date_of_birth' => '2002-03-03'],
        ];

        // Lặp qua từng sinh viên và thêm vào bảng student
        foreach ($students as $data) {
            Student::create($data);
        }

        return "Thêm dữ liệu thành công!";
    }

    public function create()
    {
        return view('admin.student.create');
    }

    // Phương thức lưu dữ liệu vào bảng student (thêm)
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:student,email',
            'date_of_birth' => 'required|date',
            'courses' => 'required|array', // Xác nhận rằng có ít nhất một khóa học được chọn
            'courses.*' => 'exists:courses,id', // Xác nhận rằng tất cả các ID khóa học đều hợp lệ
        ]);
    
        // Thêm sinh viên mới
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
        ]);
    
        // Thêm các khóa học cho sinh viên
        $student->courses()->attach($request->courses);
    
        return redirect()->route('student.index')->with('success', 'Thêm sinh viên thành công!');
    }
    

    // Hiển thị tất cả sinh viên
    public function index()
    {
        $students = Student::all(); // Lấy tất cả sinh viên
        return view('admin.student.index', compact('students')); // Trả về view với dữ liệu sinh viên
    }

    // Hiển thị chi tiết một sinh viên
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.show', compact('student'));
    }

    // Hiển thị form chỉnh sửa thông tin sinh viên
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.edit', compact('student'));
    }

    // Cập nhật thông tin sinh viên vào cơ sở dữ liệu
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:student,email,' . $id,
            'date_of_birth' => 'required|date',
        ]);

        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->route('student.index')->with('success', 'Thông tin sinh viên được cập nhật thành công.');
    }

    // Xóa sinh viên khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Sinh viên đã bị xóa thành công.');
    }

    // câu 5
    public function getAllStudentsJson()
    {
        $students = Student::all();
        return response()->json($students);
    }

    // Câu 6
    public function getStudentsWithCourses()
    {
        $students = Student::with('courses')->get();
        return response()->json($students);
    }
}
 