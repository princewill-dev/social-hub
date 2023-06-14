<x-profilecontent :sharedData="$sharedData">
  <div class="list-group">
    @foreach ($posts as $post)
    <a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
      <img class="avatar-tiny" src="/storage/img/{{$post->user->avatar}}" />
      <strong>{{$post -> title}}</strong> on {{$post -> created_at}}
    </a>
    @endforeach
  </div>
</x-profilecontent>

