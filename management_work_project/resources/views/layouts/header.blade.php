<link rel="stylesheet" href="pages/navbarHome.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="pages\fontawesome-free-6.5.1-web\css\all.min.css">
<div id="navbar">
    <ul class="navbar-left">
        <li>
            <h2 style="display: inline-block">Dira</h2>
        </li>
        <li>
            <a href="">Workspaces</a>
            <i class="bi bi-caret-down"></i>
        </li>
        <li>
            <a href="">Recently</a>
            <i class="bi bi-caret-down"></i>
        </li>
        <li>
            <a href="">Starred</a>
            <i class="bi bi-caret-down"></i>
        </li>
        <li>
            <a href="">Template</a>
            <i class="bi bi-caret-down"></i>
        </li>
        <button class="navbar-button" style="background-color: rgb(12,102,228); color: rgb(255,255,253); padding: 5px 15px; border-radius: 3px; border: none; cursor: pointer">News</button>
    </ul>

    <div class="navbar-right">
        <div class="search-input">
            <i class="bi bi-search"></i>
            <input type="text" name="" id="" placeholder="Search">
        </div>
        <div class="information-icon">
            <span>
                <i class="bi bi-bell"></i>
            </span>
            <span>
                <i class="bi bi-question-circle"></i>
            </span>
            <span>
                <img src="" alt="" srcset="">
            </span>
        </div>
        <div class="avatar open-subnav-btn">
            <img class="avtimg" src="{{Auth::user()->avatar}}" alt="avt" >
            <i class="fa-solid fa-chevron-down fa-xs" style="color: #ffffff;"></i>
            <ul class="subnav hide">
                <li><a href="#"><i class="fa-solid fa-gear"></i>Setting</a></li>
                <li><a href="{{route('profile')}}"><i class="fa-solid fa-id-badge"></i>Profile</a></li>
                <li><a href="#"><i class="fa-solid fa-info"></i>About</a></li>
                <li><a href="{{route('logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a></li>
                </ul>
        </div>
    </div>
</div>
<script src="pages/subnav.js"></script>
