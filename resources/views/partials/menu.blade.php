<div class="container">
<aside class="menu" style="background:#34314c; color:#fff">
    <br>
    <figure class="image is-128x128" style="" style="">
        <img src="{{Auth::user()->avatar}}" alt="" style="border-radius:50%; margin-left:35%;">
    </figure>
    <p class="menu-label has-text-centered" style="color:#fff">{{Auth::user()->first_name}} {{Auth::user()->last_name}} @if(Auth::user()->usergroup > 1)<span><i class="fa fa-check-circle fa-lg"></i></span>@endif</p>
    <nav class="level">
        <div class="level-item has-text-centered">
            <p class="heading">Followers</p>
            <p class="title" style="color:#fff">{{Auth::user()->followers()->count()}}</p>
        </div>
        <div class="level-item has-text-centered">
            <p class="heading">Following</p>
            <p class="title" style="color:#fff">{{Auth::user()->following()->count()}}</p>
        </div>
    </nav>
    <ul class="menu-list">
        <li><a href="/" class="{{Route::is('home')? 'is-active' : ''}}" style="color:#fff"><i class="fa fa-home fa-lg"></i> Home</a></li>
        <li><a href="/notifications" class="{{Route::is('notifs')? 'is-active' : ''}}" style="color:#fff"><i class="fa fa-bell fa-lg"></i> Notifications</a></li>
        <li><a href="/u/{{Auth::user()->username}}" class="{{Route::is('profile',Request::segment(2))? 'is-active' : '' }}" style="color:#fff"><i class="fa fa-user-circle-o fa-lg"></i> Profile</a></li>
        @if(Auth::user()->usergroup > 2)
        <li><a href="" class="" style="color:#fff"><i class="fa fa-dashboard fa-lg"></i> Dashboard</a></li>
        @endif
    </ul>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</aside>
</div>