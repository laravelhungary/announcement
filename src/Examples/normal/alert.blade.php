@foreach($announcements as $announcement)
    <div class="alert alert-{{ $announcement->type }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ $announcement->title }}</strong> {{ $announcement->message }}
    </div>
@endforeach