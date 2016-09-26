<?php

namespace LaravelHungary\Announcement;

use Redis;
use App\Events\NewAnnouncement;
use Illuminate\Support\Collection;

class Announcement
{
    /**
     * Type of the announcement. For example: success,info,danger,warning (or anything you would like to use).
     *
     * @var
     */
    public $type;
    /**
     * It should be a short message, that what is the message about. For example: Breaking news!
     *
     * @var
     */
    public $title;
    /**
     * A bit longer message that what is the situation. For example: Our servers are under a DDoS attack. We are trying hard to mitigate it.
     *
     * @var
     */
    public $message;

    /**
     * When should the announcement expire. [Time to live] in seconds.
     *
     * @var
     */
    public $ttl;

    /**
     * Announcement constructor.
     *
     * @param $type
     * @param $title
     * @param $message
     * @param int $ttl
     */
    public function __construct($type, $title, $message, $ttl)
    {
        $this->type                 = $type;
        $this->title                = $title;
        $this->message              = $message;
        $this->ttl                  = $ttl;
    }

    public function save()
    {
        $key = $this->key();
        Redis::set($key, $this->message);
        Redis::expire($key, $this->ttl);
    }

    public function key()
    {
        return config('announcement.redis_key').':'.$this->type.':'.$this->title;
    }

    public function getTtl()
    {
        return Redis::ttl($this->key());
    }

    public function setTtl($seconds)
    {
        return Redis::expire($this->key(), $seconds);
    }

    public static function all()
    {
        $keys = Redis::keys(config('announcement.redis_key').':*');
        if ( ! $keys) {
            return [];
        }

        $collection = new Collection();

        foreach ($keys as $key) {
            $key_data     = explode(':', $key, 3);
            $message      = Redis::get($key);
            $ttl          = Redis::ttl($key);
            $announcement = new self($key_data[1], $key_data[2], $message, $ttl);
            $collection->push($announcement);
        }

        return $collection;
    }
}
