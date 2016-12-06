<?php

namespace LaravelHungary\Announcement;

use App\Events\NewAnnouncement;

class Announce
{
    /**
     * [create description].
     *
     * @param string $title
     * @param string $message
     * @param string $type
     * @param int    $ttl
     *
     * @return [type] [description]
     */
    public static function create($title = '', $message = '', $type = 'info', $ttl = 60)
    {
        $announcement = new Announcement($title, $message, $type, $ttl);
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
     * [broadcast description].
     *
     * @param string $title
     * @param string $message
     * @param string $type
     * @param int    $ttl
     * @param string $transition
     * @param [type] $channel_name
     *
     * @return [type]
     */
    public static function broadcast($title = '', $message = '', $type = 'info', $ttl = 60, $transition = 'fade', $channel_name = null)
    {
        if ( ! $channel_name) {
            $channel_name = config('announcement.broadcasting_channel');
        }

        $ttl = $ttl * 1000;

        event(new NewAnnouncement($title, $message, $type, $ttl, $transition, $channel_name));
    }
}
