<aside class="sidebar">
    <div class="sidebar-in">
        <header>
            <div class="logo">
                <a href="{{Route('home')}}">
                    <img src="{{asset('assets/images/logo.png')}}" alt="career planning" />
                </a>
            </div>
            <a href="#" class="togglemenu">&nbsp;</a>
            <div class="clearfix"></div>
        </header>

        <nav class="navigation">
            <ul class="navi-acc" id="nav2">
                <li>
                    <a href="{{Route('home')}}" class="dashboard">Dashboard</a>
                </li>
                <li>
                    <a href="#akun" class="loginoptions">Akun Saya</a>
                    <ul>
                        <li><a href="{{Route('profil')}}">Pengaturan Akun</a></li>
                        <li><a href="{{Route('profil')}}/gantiSandi">Ganti Kata Sandi</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#plan" class="forms">Perencanaan</a>
                    <ul>
                        <li><a href="{{Route('plan')}}/input">Input Planning</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{Route('hasil_plan')}}">Hasil Plan</a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </nav>

        <span class="shadows"></span>

    </div>
</aside>