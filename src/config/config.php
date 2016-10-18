<?php

return [

    /*
     * The Redis Key We Will Use To Announce Over
     */
    'redis_key' => 'announcements',

    /*
     * The Broadcasting Channel
     *
     * Dont Forget To Also Change It In The Component File
     */
    'broadcasting_channel' => env('ANNOUNCEMENTS-CHANNEL', 'public-announcement-channel'),
];
