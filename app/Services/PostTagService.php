<?php

namespace App\Services;

class PostTagService
{
    public function store($post, $tags) {
        $tag_array = explode(',', $tags);
        
        $tag_array = array_map(function ($tag) {
            return ['name' => $tag];
        }, $tag_array);
       
        $post->tags()->createMany($tag_array);
    }
}
