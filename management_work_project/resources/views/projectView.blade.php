<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="project_ID" content="{{ $project->id }}">
    <meta name="workspace_ID" content="{{ $workspace->id }}">
    <meta name="updateworkspaceurl" content="{{ route('update_Workspace', ['workspace' => $workspace->id]) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="pages/projectView.css">
    <link rel="stylesheet" href="pages\fontawesome-free-6.5.1-web\css\all.min.css">
    @vite(['resources/js/app.js'])
</head>

<body>
    @include('layouts.header')
    <div class="body">
        <div class="folders">
            @include('sidebar.folder')
        </div>
        <!-- Add people board -->

        <div class="add-people-board">
            <div class="name-function-share">
                <h2>Share board</h2>
                <i class="bi bi-x"></i>
            </div>

            <form action="" method="post">
                @csrf
                <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                <input type="text" name="email" id="" value="Email">
                <button>Member</button>
                <input type="submit" value="Share">
            </form>

            <div class="link-add">
                <div class="link-icon">
                    <i class="bi bi-link-45deg"></i>
                </div>

                <div class="capacity-member">
                    <p style="color: rgb(141,151,168);">Anybody have link board</p>
                    <a href="">Copy link</a>
                </div>

                <button>Can join as a member</button>
            </div>

            <div class="members">

                @foreach ($users_workspace as $user_workspace)
                    <div class="member-single">

                        <span>
                            <img src="" alt="" srcset="" width="25px" height="25px">
                        </span>
                        <p>{{ $user_workspace->name }}</p>
                        <button>Member</button>
                    </div>
                @endforeach
                @if (session('error_user'))
                    <h1>{{ session('error_user') }}</h1>
                @endif
            </div>
        </div>

        <div class="test-button-add-people">
            <input type="button" value="Share">
        </div>

        <div class="workspace">
            <div class="workspace-header">
                <img src="pages/image/Rectangle.png" class="avatar">
                <div>
                    <div class="workspace-name">
                        <span id="workspace-name" title="{{ $workspace->name }}">
                            {{ $workspace->name }}
                        </span>
                        <button class="edit"><img src="pages/image/pencil.png"></button>
                    </div>
                </div>
            </div>
            <div class="_container">
                <div class="title">
                    <img src="pages/image/arrow_down.png"
                        style="transform: rotate(90deg); height: fit-content; width: fit-content; cursor: pointer;"
                        onclick="window.location.href='{{ route('update_Workspace', ['workspace' => $workspace->id]) }}'">
                    <img src="pages/image/project-icon.png">
                    <span id="project-name" title="{{ $project->name }}">{{ $project->name }}</span>
                    <button id="deleteproject-btn">Delete project</button>
                </div>
                <div class="project-container">
                    @if (isset($columns))
                        @foreach ($columns as $column)
                            <div class="list-item" draggable="true" id="{{ $column->id }}"
                                index="{{ $column->index }}">
                                <div class="block-select">
                                    <div class="block-wall"></div>
                                    <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">{{ $column->title }}</textarea>
                                </div>
                                <div class="cards">
                                    @if (isset($column->cards))
                                        @foreach ($column->cards as $card)
                                            <div class="card-item" draggable="true" index="{{ $card->index }}"
                                                id="{{ $card->id }}">
                                                {{ $card->title }}
                                            </div>
                                        @endforeach
                                    @endif
                                    <button class="addcardbtn">Add +</button>
                                </div>
                                <button class="deletelist-btn">Delete this list
                                </button>
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
    <script src="pages/project.js"></script>
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
        import '{{ mix('resources/js/app.js') }}';
        window.Echo.private('project.{{ $project->id }}')
            .listen("CardCreated", function(e) {
                const card = e.card;
                console.log(e);
                EventHandle.newCardElement(card.id, card.title, card.list_ID);
            })
            .listen("ModifyCardPosition", function(e) {
                const card = e.card;
                console.log(e);
                EventHandle.moveCard(card.id, card.index, card.list_ID);
            })
            .listen("ModifyListPosition", function(e) {
                const list = e.list;
                console.log(e);
                EventHandle.moveList(list.id, list.index);
            })
            .listen("ModifyListTitle", function(e) {
                const list = e.list;
                console.log(e);
                EventHandle.modifyListTitle(list.id, list.title);
            })
            .listen("ListCreated", function(e) {
                const list = e.list;
                console.log(e);
                EventHandle.newListElement(list.id, list.title, list.index);
                EventHandle.addCardButton();
                applyDragableIntoCard(".cards", ".card-item");
            })
            .listen("ListDeleted", function(e) {
                const list = e.list;
                console.log(e);
                EventHandle.removeListItemElement(list.id);
            });
    </script>
</body>

</html>
