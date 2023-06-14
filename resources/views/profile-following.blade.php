<x-profilecontent>
    <div class="list-group">
      @foreach ($following as $follow)
      <a href="/post/{{$follow->userBeingFollowed->username}}" class="list-group-item list-group-item-action">
        <img class="avatar-tiny" src="/storage/img/{{$follow->userBeingFollowed->avatar}}" />
     {{$follow->userBeingFollowed->username}}
      </a>
      @endforeach
    </div>
  </x-profilecontent>
  
  