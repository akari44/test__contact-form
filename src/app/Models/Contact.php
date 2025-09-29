<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];
    //リレーション//
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //// --- 名前検索（姓・名・フルネーム）
    public function scopeKeywordSearch($query, $keyword)
{
    if (!empty($keyword)) {
        $query->where(function($q) use ($keyword) {
            $q->where('first_name', 'like', "%{$keyword}%")
              ->orWhere('last_name', 'like', "%{$keyword}%")
              ->orWhereRaw("CONCAT(first_name, last_name) LIKE ?", ["%{$keyword}%"])
              ->orWhere('email', 'like', "%{$keyword}%");
        });
    }
}

    // --- メール検索（部分一致）
    public function scopeEmailSearch($query, $email)
    {
        if (!empty($email)) {
            $query->where('email', 'like', "%{$email}%");
        }
    }

    // --- 性別検索（1:男性,2:女性,3:その他）
    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender) && $gender !== 'all') {
            $query->where('gender', $gender);
        }
    }

    // --- カテゴリ検索
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    // --- 日付検索（created_at）
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
    }

}
