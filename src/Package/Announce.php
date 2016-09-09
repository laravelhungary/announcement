<?php

namespace LaravelHungary\Announcement;

use Redis;

class Announce
{

    static public function create($type = 'info', $title = '', $message = '', $ttl = 60)
    {
        $announcement = new Announcement($type, $title, $message, $ttl);
        $announcement->save();
    }

    static public function display()
    {
        $announcements = Announcement::all();

        return view('announcement::alert',compact('announcements'))->render();
    }
}
