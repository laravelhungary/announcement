@foreach($announcements as $announcement)
  <div class="alert alert-{{ $announcement->type }}">
    <strong>{{ $announcement->title }}</strong> {{ $announcement->message }}
  </div>
@endforeach