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
                <i class="bi bi-bell notificate-icon">
                    
                <i class="bi bi-dot signal-icon"></i>

                </i>
            </span>
            <span>
                <i class="bi bi-question-circle"></i>
            </span>
            <span>
                <img src="" alt="" srcset="">
            </span>

            <div class="information-notificate">
            @if (isset($notification_user))
        
            @foreach($notification_user as $notification)
            @php
                $decodedNotifications = json_decode($notification, true);
            @endphp
                <div class="element-notificate">
                    <p class="name-sender">{{ $decodedNotifications['data'][0] }} đã thêm</p>
                    <img src="{{ $decodedNotifications['data'][1] }}" alt="" srcset="">
                    <p class="message-sender">Bạn vào nhóm {{ $decodedNotifications['data'][2] }}</p>
                </div> 
            @endforeach
        @endif
</div>

            
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
<script type="module">
    let signal_icon = document.querySelector(".navbar-right .information-icon .signal-icon");
    let information_notificate = document.querySelector(".navbar-right .information-icon .information-notificate");
    let notificate_icon = document.querySelector(".navbar-right .information-icon .notificate-icon");
    let element_notificate = document.querySelector(".navbar-right .information-icon .information-notificate .element-notificate");

    import '{{mix('resources/js/app.js')}}';
    window.Echo.private(`AddPeopleOnTeam.{{ session('id_user') }}`)
    .listen('AddPeople', (e) => {
        console.log(e);
        signal_icon.style.display = 'block';

        let element_notificate = document.createElement('div');
        element_notificate.classList.add('element-notificate');

        let name_sender = document.createElement('p');
        name_sender.classList.add('name-sender');
        name_sender.innerText = e.data[0];

        let img_sender = document.createElement('img');
        img_sender.src = e.data[1];;

        let message_sender = document.createElement('p');
        message_sender.classList.add('message-sender');
        message_sender.innerText = e.data[0] + " " + "đã mời bạn vào nhóm";

        element_notificate.appendChild(name_sender);
        element_notificate.appendChild(img_sender);
        element_notificate.appendChild(message_sender);
        information_notificate.appendChild(element_notificate);

        });

        notificate_icon.addEventListener('click', function() {
            element_notificate.style.display = (element_notificate.style.display == 'block') ? 'none' : 'block';
 });  
</script>



