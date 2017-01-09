<nav class="nav is-bold" style="background:#47b8e0; height:{{Auth::check()? '100px' :  ''}}">
    <div class="container">
    <div class="nav-left">
        <a href="/" class="nav-item is-brand">
            <h1 class="title white">&nbsp;Tragala</h1>
        </a>
    </div>
    <div class="nav-right nav-menu">
    @if(Auth::guest())
        <a href="/register" class="nav-item" style="color:#fff">Register</a>
        <span class="nav-item"><a href="/login" class="button is-primary is-medium is-outlined" style="color:#fff;border-color:#fff">Login</a></span>
    @else
        <form-post></form-post> 
        <unread></unread>
        <a href="" class="nav-item" style="color:#fff"><i class="fa fa-search fa-lg"></i></a>
        <a href="" class="nav-item" style="color:#fff"><i class="fa fa-gear fa-lg"></i></a>
        <a class="nav-item" style="color:#fff" onclick="event.preventDefault();document.getElementById('logout').submit();">Logout</a>
    <form id="logout" style="display:none" method="POST" action="/logout">
        {{csrf_field()}}        
    </form>
    @endif
    </div>
    </div>
</nav>