<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    {{-- </base> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
</head>

<body>
    @include('layouts.header')    
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
                    Projects
                </div>
                <div class="project-list">
                    @if (isset($randomProjects))
                        @foreach ($randomProjects as $randomProject)
                            <div class="item" id="{{ $randomProject->id }}" draggable="true">
                                <span class="disable-select">{{ $randomProject->name }}</span>
                                <div class="progress-bar"
                                    style="background: linear-gradient(90deg, #fdbd19 {{ $randomProject->rate }}%, #d9d9d9 0%);">
                                </div>
                                <div class="progress-percent">{{ $randomProject->rate }}%</div>
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
</body>

</html>
