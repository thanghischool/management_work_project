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
    <link rel="stylesheet" href="pages/navbarHome.css">

</head>

<body>
    <div class="pseudo-opacity">
    </div>


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
            <button class="navbar-button"
                style="background-color: rgb(12,102,228); color: rgb(255,255,253); padding: 5px 15px; border-radius: 3px; border: none; cursor: pointer">News</button>
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

        <div class="new-workspace">

            <div class="create-workspace">
                <form action="{{ route('create_Workspace') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h1>Let's build a Workspace</h1>
                    <h3 style="margin: 30px 0; color: rgb(97,110,133)">Increase your productivity by helping
                        everyone
                        <br>people easily access
                        the board in one location.
                    </h3>
                    <label for="name_workspace">Workspace Name</label> <br>
                    <input type="text" name="name_workspace" style="width: 100%; height: 30px; margin: 30px 0;"><br>

                    <label for="">Workspace Avatar </label> <br>
                    <input type="file" name="avatar_workspace" style=" margin: 30px 0;"> <br>

                    <input type="submit" value="Continue" style="width: 100%; height: 30px">
                </form>
            </div>
            <div class="background-right-workspace">
                <img src="pages/image/background.png" alt="" style="width: 100%; height: 332px">
            </div>


        </div>
    </div>


    <div class="new-workspace">

        <div class="create-workspace">
            <form action="{{ route('create_Workspace') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h1>Let's build a Workspace</h1>
                <h3 style="margin: 30px 0; color: rgb(97,110,133)">Increase your productivity by helping everyone
                    <br>people easily access
                    the board in one location.
                </h3>
                <label for="name_workspace">Workspace Name</label> <br>
                <input type="text" name="name_workspace" style="width: 100%; height: 30px; margin: 30px 0;"><br>

                <label for="">Workspace Avatar </label> <br>
                <input type="file" name="avatar_workspace" style=" margin: 30px 0;"> <br>

                <input type="submit" value="Continue" style="width: 100%; height: 30px">
            </form>
        </div>
        <div class="background-right-workspace">
            <img src="pages/image/background.png" alt="" style="width: 100%; height: 332px">
        </div>


    </div>



    <!-- Create new board -->
    <script>
    let navbar_button = document.querySelector(".navbar-button");
    navbar_button.addEventListener("click", function add_workspace(e) {
        let new_workspace = document.querySelector(".new-workspace");
        let pseudo_opacity = document.querySelector(".pseudo-opacity");
        let body = document.body;

        new_workspace.style.display = "flex";
        pseudo_opacity.style.display = "block";


    });
    </script>

    <script src="pages/script.js"></script>
    <script src="pages/dragable.js"></script>
    <script>
    applyDragableIntoList(".project-list", ".item:not(.button)");
    </script>

    <script src="pages/editable.js"></script>
</body>

</html>