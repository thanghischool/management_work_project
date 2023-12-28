<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="{{ asset('') }}">
    </base>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="pages/projectView.css">
    <link rel="stylesheet" href="pages/navbarHome.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
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

                @foreach($users_workspace as $user_workspace)
                <div class="member-single">

                    <span>
                        <img src="" alt="" srcset="" width="25px" height="25px">
                    </span>
                    <p>{{ $user_workspace->name }}</p>
                    <button>Member</button>
                </div>

                @endforeach
                @if(session('error_user'))
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
                    <img src="pages/image/arrow_down.png"
                        style="transform: rotate(90deg); height: fit-content; width: fit-content;">
                    <img src="pages/image/project-icon.png">
                    {{ $project->name }}
                </div>
                <div class="project-container">
                    @if(isset($columns))
                    @foreach($columns as $column)
                    <div class="list-item" draggable="true" id="{{ $column->id }}" index="{{$column->index}}">
                        <div class="block-select">
                            <div class="block-wall"></div>
                            <textarea class="list-title" name="" id="" cols="30" rows="10"
                                spellcheck="false">{{ $column->title }}</textarea>
                        </div>
                        <div class="cards">
                            @if(isset($column->cards))
                            @foreach($column->cards as $card)
                            <div class="card-item" draggable="true" index="{{ $card->index }}" id="{{ $card->id }}">
                                {{ $card->title }}
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>



            </div>
        </div>
    </div>



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
    import '{{mix('
    resources / js / bootstrap.js ')}}';
    window.Echo.private('project.{{$project->id}}')
        .listen("CardCreated", function(e) {
            const card = e.card;
            console.log(e);
            EventHandle.newCardElement(card.title, card.index, card.list_ID);
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
        });
    </script>
</body>

</html>