![Announcement](http://demo.hocza.com/github/laravel-announcement/laravel-announcement.png)
# Laravel Announcement

A package that simplifies the management of site-wide announcements. With "Laravel Announcement" you can display auto-expiring announcements.

To achieve this the package simply uses the Redis's TTL.

## Installation

1- `composer require laravelhungary/announcement`

2- Add the followings to `config/app.php`

```php
'providers' => [
    ...

    LaravelHungary\Announcement\PackageServiceProvider::class,
],

'aliases' => [
    ...

    'Announce' => LaravelHungary\Announcement\Facades\Announce::class,
]
```
3- That's it.

## Usage

### Create Announcement
`Announce::create($type,$title,$message,$ttl);`

Params
* `type` Type of the announcement. For example: success,info,danger,warning (or anything you would like to use)
* `title` It should be a short message, that what is the message about. For example: Breaking news!
* `message` A bit longer message that what is the situation. For example: Our servers are under a DDoS attack. We are trying hard to mitigate it.
* `ttl` When should the announcement expire. [Time to live] in seconds.

### Display of Announcements
`{!! Announce::display() !!}`

If you would like to override the default bootstrap alerts, feel free to create your own in `resources/views/vendor/announcement/alert.blade.php`

**example:**

```blade
@foreach($announcements as $announcement)
  <div class="alert alert-{{ $announcement->type }}">
    <strong>{{ $announcement->title }}</strong> {{ $announcement->message }}
  </div>
@endforeach
```

## Package dependencies

"predis/predis"
