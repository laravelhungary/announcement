<?php

namespace LaravelHungary\Announcement;

use App\Events\NewAnnouncement;

class Announce
{
    /**
     * create new announcement.
     *
     * @param string $type
     * @param string $title
     * @param string $message
     * @param int    $ttl
     *
     * @return [type]
     */
    public static function create($type = 'info', $title = '', $message = '', $ttl = 60)
    {
        $announcement = new Announcement($type, $title, $message, $ttl);
        $announcement->save();
    }

    /**
     * display the announcement.
     *
     * @return [type]
     */
    public static function display()
    {
        $announcements = Announcement::all();

        return view('announcement::alert', compact('announcements'))->render();
    }

    /**
     * broadcast a public announcement.
     *
     * @param string $type
     * @param string $title
     * @param string $message
     * @param string $channel_name
     *
     * @return [type]
     */
    public static function broadcast($type = 'info', $title = '', $message = '', $ttl = 60, $transition = null, $channel_name = null)
    {
        if ( ! $channel_name) {
            $channel_name = env('ANNOUNCEMENTS-CHANNEL');
        }

        $ttl = $ttl * 1000;

        event(new NewAnnouncement($type, $title, $message, $ttl, $channel_name));
    }
}
