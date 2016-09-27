![Announcement](http://demo.hocza.com/github/laravel-announcement/laravel-announcement.png)
# Laravel Announcement

A package that simplifies the management of site-wide announcements. With "Laravel Announcement" you can display auto-expiring announcements.

To achieve this the package simply uses the Redis's TTL.

## Installation

1- `composer require laravelhungary/announcement`
- this package also requires **`predis/predis`** to be installed in-order to work

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

> if you need to broadcast the announcements through something like web-sockets please check [Echo Installation](https://laravel.com/docs/5.3/broadcasting#installing-laravel-echo)

## Usage

### Normal
#### Create Announcement
`Announce::create($type, $title, $message, $ttl);`

Params
* `type` Type of the announcement.

> For example: success,info,danger,warning (or anything you would like to use)

* `title` a short message.

> For example: Breaking news!

* `message` A bit longer message.

> For example: Our servers are under a DDoS attack. We are trying hard to mitigate it.

* `ttl` When should the announcement expire. [Time to live] in seconds.

> Default is: 60 seconds

#### Display of Announcements

put `{!! Announce::display() !!}` anywhere you want your announcement to be visible.

===

### Broadcasting
#### Create Announcement
`Announce::broadcast($type, $title, $message, $ttl, $transition, $channel_name);`

Params
* `type`,`title`,`message`,`ttl` same as the [normal](#normal) announcement

* `transition` what is animation type you want.

> For example: fade , bounce, etc... [Check Vue Transition](http://vuejs.org/guide/transitions.html#CSS-Transitions)

* `channel_name` the channel name we will use to broadcast the announcement over.

> Default is: `public-announcement-channel` which you can override it directly through the method call or through your ***.env*** file under **ANNOUNCEMENTS-CHANNEL**

#### Display of Announcements
- note that the package doesnt care what driver you use `pusher` or `socket.io` , it will just work 🍺.
- we also use **VueJs**, but if you want to use something else then ignore the below and you are free to build your own.

1- put
`Vue.component('my-announcement', require('../../vendor/laravelhungary/announcement/src/components/Announcement-bootstrap.vue'));`
into your **app.js** file

2- put `<my-announcement></my-announcement>` anywhere you want this announcement to show up. For example: your **layout.blade.php** file

3- dont forget to [Check Vue Transition](http://vuejs.org/guide/transitions.html#CSS-Transitions).

>  if you want to use `Animate.css` just copy the css code into the `*-enter` & `*-leave` classes in your css file and your are done 🎉.
