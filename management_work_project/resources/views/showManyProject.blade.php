<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="workspace_ID" content="{{ $getWorkspace->id }}">
    <meta name="updateworkspaceurl" content="{{ route('update_Workspace', ['workspace' => $getWorkspace->id]) }}">
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
                        <span id="workspace-name" title="{{ $getWorkspace->name }}">
                            @isset($getWorkspace)
                                {{ $getWorkspace->name }}
                            @endisset
                        </span>
                        <button class="edit"><img src="pages/image/pencil.png"></button>
                    </div>
                </div>

            </div>
            <div class="_container">
                <div class="title">
                    <img src="pages/image/project-icon.png">
                    Your Projects
                </div>
                <div class="project-list">
                    @if (isset($projects_getworkspace))
                        @foreach ($projects_getworkspace as $project_getworkspace)
                            <div class="item" id="{{ $project_getworkspace->id }}"
                                onclick="project_specific('{{ $project_getworkspace->id }}')">
                                <span class="disable-select"
                                    title="{{ $project_getworkspace->name }}">{{ $project_getworkspace->name }}</span>
                                <div class="progress-bar"
                                    style="background: linear-gradient(90deg, #fdbd19 {{ $project_getworkspace->rate }}%, #d9d9d9 0%);">
                                </div>
                                <div class="progress-percent">{{ $project_getworkspace->rate }}%</div>
                            </div>
                        @endforeach
                    @endif
                    <div id="addproject-btn" class="item" style="display: inline-block; position: relative;">
                        <span class="disable-select"
                            style="height: fit-content;
                        width: fit-content;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);">Add
                            +</span>
                    </div>
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
    </div>
    {{-- <form action="">
        @csrf
        <input type="text" name="" id="">
    </form> --}}

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
    @vite('resources/js/app.js')
    <script src="pages/script.js"></script>
    <script src="pages/dragable.js"></script>
    <script src="pages/showmanyproject.js"></script>
    <script>
        applyDragableIntoList(".project-list", ".item:not(.button)");
    </script>


    <script src="pages/editable.js"></script>
</body>
