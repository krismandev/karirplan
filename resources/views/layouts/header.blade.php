<header>    
    <div class="user">
        <figure>
            <a href="#"><img src="{{asset('assets/images/avatar.png')}}" alt="Admin" /></a>
        </figure>
        <div class="welcome">
            <p>Selamat Datang</p>
            <h5><a href="#">{{Auth::user()->email}}</a></h5>
        </div>
    </div>
    <div class="search-box">
        <form action="https://google.com/search" method="GET" target="_BLANK">
            <input type="text" placeholder="Cari di Google" name="q">
            <input type="submit" value="go">
        </form>
    </div>
    <form action="{{Route('logout')}}" method="post" style="display:none" id="logout">
        {{csrf_field()}}
    </form>
    <nav class="topnav">
        <ul id="nav1">
            <li class="settings">
                <a href="#" onclick="event.preventDefault();document.getElementById('logout').submit();"><i class="glyphicon glyphicon-log-out"></i> Log Out</a>
            </li>
        </ul>
    </nav>
    <div class="clearfix"></div>
</header>