<x-profilecontent>
    <div class="list-group">
      @foreach ($followers as $follow)
      <a href="/post/{{$follow->userDoingTheFollowing->username}}" class="list-group-item list-group-item-action">
        <img class="avatar-tiny" src="/storage/img/{{$follow->userDoingTheFollowing->avatar}}" />
        {{-- <strong>{{$post -> title}}</strong> on {{$post -> created_at}} --}}
      </a>
      @endforeach
    </div>
  </x-profilecontent>
  
  