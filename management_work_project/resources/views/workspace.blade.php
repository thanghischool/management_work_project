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
</head>

<body>
    <a href="{{}}">Logout</a>
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
    <script src="pages/script.js"></script>
    <script src="pages/dragable.js"></script>
    <script>
        applyDragableIntoList(".project-list", ".item:not(.button)");
    </script>
    <script src="pages/editable.js"></script>
</body>

</html>