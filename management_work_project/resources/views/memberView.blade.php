<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="pages/menber.css">
</head>

<body>
    @include('layouts.header')
    <div class="body">
        <div class="folders">
            @include('sidebar.folder')
        </div>
        <div class="workspace">
            <div class="workspace-header">
                <img src="pages/image/Rectangle.png" class="avatar">
                <div>
                    <div class="workspace-name">
                        Workspace name
                        <button class="edit"><img src="pages/image/pencil.png"></button>
                    </div>
                    <div class="ability">
                        <img src="pages/image/Vector.png">
                        private
                    </div>
                </div>
            </div>
            <div class="_container">
                <div class="title">
                    <img src="pages/image/group.png">
                    Menbers
                </div>
                <div class="invitation">
                    <div class="invitedByLink">
                        <h4 class="invitation-title">Invite members to join your group</h4>
                        <div class="invitation-body">
                            <p>Anyone with the invite link can join this free Workspace. You can also disable and create a
                                new invite link for this Workspace at any time.</p>
                            <div class="invitation-link">
                                <img src="pages/image/link.svg" alt="">
                                Invite by link
                            </div>
                        </div>
                    </div>
                    <div class="menbers">
                        <div class="menber-item">
                            <div class="left">
                                <img class="avatar"
                                    src="https://www.imagdisplays.co.uk/wp-content/uploads/2020/10/Outdoor-LED-Screen-Hire-Technical-Event-Production-iMAG.jpg"
                                    alt="">
                                <div>
                                    <span class="name">Nam Phan</span>
                                    <span class="username">@namhaycode</span>
                                </div>
                            </div>
                            <div class="right">
                                <img src="pages/image/close.svg" alt="">
                                Leave
                            </div>
                        </div>
                        <div class="menber-item">
                            <div class="left">
                                <img class="avatar"
                                    src="https://www.imagdisplays.co.uk/wp-content/uploads/2020/10/Outdoor-LED-Screen-Hire-Technical-Event-Production-iMAG.jpg"
                                    alt="">
                                <div>
                                    <span class="name">Nam Phan</span>
                                    <span class="username">@namhaycode</span>
                                </div>
                            </div>
                            <div class="right">
                                <img src="pages/image/close.svg" alt="">
                                Remove
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="pages/script.js"></script>
    <script src="pages/editable.js"></script>
</body>

</html>