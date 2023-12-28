<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="updateworkspaceurl" content="{{ route('update_Workspace',['id' => $getWorkspace->id]) }}">
    </base>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    @include('layouts.header')
    <div class="body">
        <div class="folders">
            @include('sidebar.folder')
        </div>
        <div class=" workspace">
            <div class="workspace-header">
                @isset($getWorkspace)
                <img src="{{ $getWorkspace->avatar }}" class="avatar">
                @endisset

                <div>
                    <div class="workspace-name">
                        @isset($getWorkspace)
                        {{ $getWorkspace->name }}
                        @endisset
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
                    <img src="pages/image/project-icon.png">
                    Your Projects
                </div>
                <div class="project-list">
                    @if(isset($projects_getworkspace))
                    @foreach($projects_getworkspace as $project_getworkspace)
                    <div class="item" id="{{ $project_getworkspace->id }}" draggable="true" onclick="project_specific('{{ $project_getworkspace->id }}')">
                        <span class="disable-select">{{ $project_getworkspace->name }}</span>
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
                <form action="" method="post">
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
    </div>

    <!-- Create new board -->
    <script>
        let navbar_button = document.querySelector(".navbar-button");
        navbar_button.addEventListener("click", function add_workspace(e) {
            let new_workspace = document.querySelector(".new-workspace");
            let navbar_button = document.querySelector(".navbar-button");
            let body = document.body;

            new_workspace.style.display = "flex";
            // body.style.backdropFilter = "blur(15px)";
            // new_workspace.style.opacity = "1";

        });
    </script>

    <script src="pages/script.js"></script>
    <script src="pages/dragable.js"></script>
    <script src="pages/editable.js"></script>
</body>

</html>