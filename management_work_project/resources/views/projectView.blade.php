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
    <link rel="stylesheet" href="pages/card.css">
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="pages/projectView.css">
    <link rel="stylesheet" href="pages\fontawesome-free-6.5.1-web\css\all.min.css">
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

            <form action="{{ route('addPeopleOnTeam') }}" method="post">
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
    <div class="modal hide">
        <div class="modal__inner">
            <div style="
            position: relative;
        ">
                <div class="modal__header">
                    <i class="fa-solid fa-window-maximize fa-lg" style="color: #000000;"></i>
                    <div class="name">
                        <h4 id="card-name" contenteditable="true" class="asd">NameCard</h4>
                        <p>Trong danh sánh ...</p>
                    </div>

                    <i class="fa-solid fa-xmark fa-lg close-cardform"
                        style="    color: #000000;
                    cursor: pointer;
                    position: absolute;
                    top: 0;
                    right: 0;"></i>
                </div>
                <div class="modal__body">
                    <div class="content">
                        <div class="slide">
                            <div class="slide-header">
                                <div class="name">
                                    <i class="fa-solid fa-bars fa-lg" style="color: #000000;"></i>
                                    <h4>Describe</h4>
                                </div>
                            </div>
                            <div class="slide-body">
                                <textarea name="" id="description" cols="50" rows="4" placeholder="Thêm mô tả chi tiết ..."></textarea>
                            </div>
                        </div>
                        <div id="checklist-container">
                        </div>
                        <div class="slide addfile hide">
                            <div class="slide-header">
                                <div class="name">
                                    <i class="fa-solid fa-folder-plus"></i>
                                    <h4>Add File</h4>
                                </div>
                                <button class="btnn closeaddfile">Delete</button>

                            </div>
                            <div class="slide-body">
                                <div class="cardfile ">
                                    <img src="https://trello.com/1/cards/65640252b4f1ab846184902b/attachments/656413218bb820c08ac106e9/previews/656413228bb820c08ac1079a/download/1557567429825mQH8PotXDSI7.jpg"
                                        alt="" class="fileimg">
                                    <div class="contentfile">
                                        <div class="namefile">
                                            <h4 class="namefile">File name</h4>
                                        </div>
                                        <div class="descfile">
                                            <p>30/12/2023</p>
                                        </div>
                                        <div class="btnfile">
                                            <button class="btnn">Edit</button>
                                        </div>
                                    </div>
                                    <button class="btnn cancel">Delete</button>
                                </div>


                                <button class="btnn addfilenew-btn">Add</button>
                                <ul class="subnav addfilenew hide">
                                    <li>
                                        <p>Search for or paste a link</p> <input type="text"
                                            class="addfile-content" name="linkfile">
                                    </li>
                                    <li>
                                        <div><button class="btnn closeaddfilenew cancel">Cancel</button><button
                                                type="submit" class="btnn addfile-btn-ss">Add</button></div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="slide">
                            <div class="slide-header">
                                <div class="name">
                                    <i class="fa-solid fa-list fa-lg" style="color: #000000;"></i>
                                    <h4>Activity</h4>
                                </div>
                                <button class="btnn">Show</button>
                            </div>
                            <div class="slide-body">
                                <textarea name="" id="" cols="50" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="activity">
                        <button class="btnn open-todolist-btn">To Do List</button> <br>
                        <ul class="subnav todolist-popup hide">
                            <li>
                                <p class="activity-name">Todolist</p>
                            </li>
                            <li>
                                <p style="text-align: start;">Name:</p> <input type="text" class="nameTodolist"
                                    name="nameTodolist">
                            </li>
                            <li><button class="btnn closetodolist-popup cancel">Cancel</button><button type="submit"
                                    class="btnn addtodolist-btn">Add</button></li>
                        </ul>
                        <button class="btnn open-addfile-btn">Add File</button> <br>
                        <ul class="subnav addfile-popup hide">
                            <li>
                                <p class="activity-name">Attach</p>
                            </li>
                            <li>
                                <p>Search for or paste a link</p> <input type="text" name="linkfile">
                            </li>
                            <li>
                                <div><button class="btnn closeaddfile-popup cancel">Cancel</button><button
                                        class="btnn addfile-btn">Add</button></div>
                            </li>
                        </ul>
                        <button class="btnn">chuc nang</button> <br>
                        <button class="btnn">chuc nang</button> <br>
                        <button class="delcard btnn">Delete Card</button> <br>
                    </div>
                </div>
            </div>

            <div class="modal__footer"></div>
        </div>
    </div>
    <script>
        window.users = @json($users);
    </script>
    <script src="pages/editable.js"></script>
    <script src="pages/script.js"></script>
    <script src="pages/dragable.js"></script>
    <script src="pages/project.js"></script>
    <script src="pages/checklist.js"></script>
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
