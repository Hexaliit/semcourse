<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">خانه </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/learn">دسته بندی</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">درباره ما</a>
                </li>
                @if (Auth::user())
                    <li class="nav-item">
                        <span class="nav-link text-white mx-2">{{Auth::user()->name}} خوش آمدید</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/account">پروفایل</a>
                    </li>
                @endif
            </ul>
            @auth
                <a class="navbar-brand btn btn-outline-secondary" href="/logout"><i class="fa fa-sign-out ml-2"></i>خروج</a>
            @endauth
            @guest
                <a class="navbar-brand btn btn-outline-secondary" href="/login"><i class="fa fa-sign-out ml-2"></i>ورود/ثبت
                    نام</a>
            @endguest
            <form class="form-inline mt-2 mt-md-0" method="GET" action="/search">
                <input class="form-control mr-sm-2" type="text" placeholder="دنبال جه هستید" aria-label="Search"
                       name="search">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">جستجو<i class="fa fa-search mr-2"></i>
                </button>
            </form>
        </div>
    </nav>
</header>
