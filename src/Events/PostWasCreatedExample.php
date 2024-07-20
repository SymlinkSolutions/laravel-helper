<?php

namespace JohnDoe\BlogPackage\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
// use JohnDoe\BlogPackage\Models\Post;

class PostWasCreatedExample {
    use Dispatchable, SerializesModels;

    public $post;

    // public function __construct(Post $post)
    public function __construct($post)
    {
        $this->post = $post;
    }
}

/**
 * 
 * Usage (Normally in controller?)
 * 
 * event(new PostWasCreated($post));
 * 
 */