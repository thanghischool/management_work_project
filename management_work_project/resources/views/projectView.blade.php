<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    </base>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="project_ID" content="{{ $project->id }}">
    <meta name="updateworkspaceurl" content="{{ route('update_Workspace',['id' => $workspace->id]) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="pages/projectView.css">
    <link rel="stylesheet" href="pages/navbarHome.css">
    <link rel="stylesheet" href="pages\fontawesome-free-6.5.1-web\css\all.min.css">
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
                <img src="pages/image/Rectangle.png" class="avatar">
                <div>
                    <div class="workspace-name">
                        {{ $workspace->name }}
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
                    <img src="pages/image/arrow_down.png" style="transform: rotate(90deg); height: fit-content; width: fit-content;">
                    <img src="pages/image/project-icon.png">
                    {{ $project->name }}
                </div>
                <div class="project-container">
                    @if(isset($columns))
                        @foreach($columns as $column)
                        <div class="list-item" draggable="true" id="{{ $column->id }}" index="{{$column->index}}">
                            <div class="block-select">
                                <div class="block-wall"></div>
                                <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">{{ $column->title }}</textarea>
                            </div>
                            <div class="cards">
                                @if(isset($column->cards))
                                    @foreach($column->cards as $card)
                                    <div class="card-item" draggable="true" index="{{ $card->index }}" id="{{ $card->id }}">
                                        {{ $card->title }}
                                    </div>
                                    @endforeach
                                @endif
                                <button class="addcardbtn">Add +</button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <button id="addlistbtn">Add +</button>
                </div>
            </div>
        </div>
    </div>
    <script src="pages/editable.js"></script>
    <script src="pages/script.js"></script>
    <script src="pages/dragable.js"></script>
    <script>
        applyDragableIntoList(".project-container", ".list-item");
        applyDragableIntoCard(".cards", ".card-item");
    </script>
    <script src="pages/list.js"></script>
    <script>
        applyEditableTitleToList(".list-item", ".list-title", ".block-wall");
    </script>
    <script src="pages/editable.js"></script>
    <script type="module">
        import * as EventHandle from './pages/CardEventModule.js';
        import '{{mix('resources/js/app.js')}}';
        window.Echo.private('project.{{$project->id}}')
        .listen("CardCreated", function (e) {
            const card = e.card;
            console.log(e);
            EventHandle.newCardElement(card.id, card.title, card.list_ID);
        })
        .listen("ModifyCardPosition", function (e) {
            const card = e.card;
            console.log(e);
            EventHandle.moveCard(card.id, card.index, card.list_ID);
        })
        .listen("ModifyListPosition", function (e) {
            const list = e.list;
            console.log(e);
            EventHandle.moveList(list.id, list.index);
        })
        .listen("ModifyListTitle", function (e) {
            const list = e.list;
            console.log(e);
            EventHandle.modifyListTitle(list.id, list.title);
        })
        .listen("ListCreated", function (e) {
            const list = e.list;
            console.log(e);
            EventHandle.newListElement(list.id, list.title, list.index);
            EventHandle.addCardButton();
            applyDragableIntoCard(".cards", ".card-item");
        });
    </script>
</body>

</html>