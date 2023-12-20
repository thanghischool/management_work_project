<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    </base>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
</head>

<body>
    <div class="folders">
        @include('sidebar.folder')
    </div>
    <div class="workspace">
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
                    @isset($getWorkspace)
                    <img src="{{ $getWorkspace->avatar }}">
                    @endisset
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
                <div class="item" id="{{ $project_getworkspace->id }}" draggable="true">
                    <span class="disable-select">{{ $project_getworkspace->name }}</span>
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