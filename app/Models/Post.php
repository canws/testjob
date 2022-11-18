<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'featured_image',
    ];

    public static function savePost($data, $image_name){
        $post = Post::create([
            'title' => (isset($data['title']) ? $data['title'] : ''),
            'body' => (isset( $data['description']) ?  $data['description'] : ''),
            'featured_image' => (isset($image_name) ? $image_name : ''),
        ]);

        return $post ? true : false;
    }

    public static function updatePost($data, $image_name){
        $post = Post::where('id', $data['id'])->update([
            'title' => (isset($data['title']) ? $data['title'] : ''),
            'body' => (isset( $data['description']) ?  $data['description'] : ''),
            'featured_image' => (isset($image_name) ? $image_name : ''),
        ]);

        return $post ? true : false;
    }
}
