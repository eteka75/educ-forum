<?php

namespace Event;

use Illuminate\Session\Store;
use App\Models\Post;

class ViewPostHandler {

    private $session;

    public function __construct(Store $session) {
        // Let Laravel inject the session Store instance,
        // and assign it to our $session variable.
        $this->session = $session;
    }

    public function handle(Post $post) {
        if (!$this->isPostViewed($post)) {
            $post->increment('view_counter');
            $post->view_counter += 1;

            $this->storePost($post);
        }
    }

    private function isPostViewed($post) {
        $viewed = $this->session->get('viewed_posts', []);

        // Check if the post id exists as a key in the array.
        return array_key_exists($post->id, $viewed);
    }

    private function storePost($post) {
        // First make a key that we can use to store the timestamp
        // in the session. Laravel allows us to use a nested key
        // so that we can set the post id key on the viewed_posts
        // array.
        $key = 'viewed_posts.' . $post->id;

        // Then set that key on the session and set its value
        // to the current timestamp.
        $this->session->put($key, time());
    }

}
