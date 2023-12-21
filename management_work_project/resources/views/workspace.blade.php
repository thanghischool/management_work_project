<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    </base>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
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
            <button style="background-color: rgb(12,102,228); color: rgb(255,255,253); padding: 5px 15px; border-radius: 3px; border: none; cursor: pointer">News</button>
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

    <div class="folders" style="margin-top: 110px !important;">
        @include('sidebar.folder')
    </div>
    <div class="workspace">
        <div class="workspace-header">
            <!-- <img src="pages/image/Rectangle.png" class="avatar">
            <div>
                <div class="workspace-name">
                    Workspace name
                    <button class="edit"><img src="pages/image/pencil.png"></button>
                </div>
                <div class="ability">
                    <img src="pages/image/Vector.png">
                    private
                </div>
            </div> -->
            <div class="recent-project" style="display: flex;">
                <i class="bi bi-clock" style="height:fit-content"></i>
                <h6 style="margin: 0 0 0 20px; line-height: 36px">Đã xem gần đây</h6>
            </div>
        </div>
        <div class="_container">
            <div class="title">
                <img src="pages/image/project-icon.png">
                Your Projects
            </div>
            <div class="project-list">
                @if(isset($randomProjects))
                @foreach($randomProjects as $randomProject)
                <div class="item" id="{{ $randomProject->id }}" draggable="true">
                    <span class="disable-select">{{ $randomProject->name }}</span>
                    <div class="progress-bar"></div>
                    <div class="progress-percent">10%</div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <script src="pages/script.js"></script>
    <script src="pages/dragable.js"></script>
    <script>
        applyDragableIntoList(".project-list", ".item:not(.button)");
    </script>
    <script src="pages/editable.js"></script>
</body>

</html>