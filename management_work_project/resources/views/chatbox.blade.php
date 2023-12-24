<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <base href="{{ asset('') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css" />
    <link rel="stylesheet" href="pages/chatBox.css" />
    <link rel="stylesheet" href="pages/navbarHome.css">
</head>

<body>
    <div class="navbar">
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
        </div>

    </div>
    <div class="body">
        <div class="folders">
            @include('sidebar.folder')
        </div>
        <div class="workspace">
            <div class="workspace-header">
                <img src="pages/image/Rectangle.png" class="avatar" />
                <div>
                    <div class="workspace-name">
                        Workspace name
                        <button class="edit">
                            <img src="pages/image/pencil.png" />
                        </button>
                    </div>
                    <div class="ability">
                        <img src="pages/image/Vector.png" />
                        private
                    </div>
                </div>
            </div>
            <div class="_container">
                <div class="title">
                    <img src="pages/image/chatbox.png" />
                    Chat Box
                </div>
                <div class="chatbox">
                    <div class="chatbox-header">
                        <div class="left">
                            <div class="group-name">Name Chat Box</div>
                        </div>
                        <div class="right">
                            <img src="pages/image/phone.svg" alt="" />
                            <img src="pages/image/video.svg" alt="" />
                        </div>
                    </div>
                    <div class="chatbox-body">
                        <div class="date">Today</div>
                        <div class="friend-message">
                            <img src="pages/https://th.bing.com/th/id/OIP.6MMa2g_P8UGnJgsiDiQ1LwHaEJ?rs=1&pid=ImgDetMain" alt="" class="mini-avatar" />
                            <div class="message-content">
                                <span class="friend-name">Hoang Quoc</span>
                                <p>Have a great working week!!</p>
                                <p>Hope you like it</p>
                                <div class="message-time">09:25 AM</div>
                            </div>
                        </div>
                        <div class="your-message">
                            <div class="message-content">
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <p>You did your job well!</p>
                                <div class="message-time">09:25 AM</div>
                            </div>
                        </div>
                    </div>
                    <div class="chatbox-footer">
                        <img src="pages/image/microphone.svg" alt="" />
                        <input id="message" type="text" placeholder="Write your message" />
                        <div>
                            <img src="pages/image/sticker.svg" alt="" />
                            <img src="pages/image/camera.svg" alt="" />
                            <img src="pages/image/attachment.svg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="pages/script.js"></script>
    <script src="pages/editable.js"></script>
    <script type="module" src="{{ mix('resources/js/app.js') }}" defer></script>
</body>
</html>