<div class="tabs" style="background:#fff;">
    <ul>
        <li class="{{Request::is('home')? 'is-active' : ''}}"><a href="/home">Feed</a></li>
        <li class="{{Request::is('trending')? 'is-active' : ''}}"><a href="">Trending</a></li>
        <li class="{{Request::is('latest')? 'is-active' : ''}}"><a href="/latest">Latest</a></li>
        <li class="{{Request::is('hot')? 'is-active' : ''}}"><a href="/hot">Hot</a></li>
    </ul>
</div>