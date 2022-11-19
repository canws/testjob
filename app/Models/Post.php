<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'featured_image',
    ];

    public static function savePost($data, $image_name){
        $post = Post::create([
            'user_id' => (Auth::check() ? Auth::id() : 0),
            'title' => (isset($data['title']) ? $data['title'] : ''),
            'slug' => (isset($data['title']) ? Str::of($data['title'])->slug('-') : ''),
            'body' => (isset( $data['description']) ?  $data['description'] : ''),
            'featured_image' => (isset($image_name) ? $image_name : ''),
        ]);

        return $post ? true : false;
    }

    public static function updatePost($data, $image_name){
        $post = Post::where('id', $data['id'])->update([
            'title' => (isset($data['title']) ? $data['title'] : ''),
            'slug' => (isset($data['title']) ? Str::of($data['title'])->slug('-') : ''),
            'body' => (isset( $data['description']) ?  $data['description'] : ''),
            'featured_image' => (isset($image_name) ? $image_name : ''),
        ]);

        return $post ? true : false;
    }
}
