<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Chỉ định bảng 'student' nếu bạn không dùng chuẩn đặt tên bảng mặc định
    protected $table = 'student';

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'name',
        'email',
        'date_of_birth'
    ];

    // Liên kết với model Course
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
