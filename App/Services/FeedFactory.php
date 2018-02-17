<?php namespace App\Services;

use FastFeed\Factory as FastFeed;

class FeedFactory {
    public function get() {
        $fastFeed = FastFeed::create();
        $fastFeed->addFeed('default', getenv('RSS'));
        $items = $fastFeed->fetch('default');

        return $items;
    }
}