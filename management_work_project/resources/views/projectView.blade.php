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
</head>

<body>
    <div class="folders">
        @include('sidebar.folder')

    </div>
    <div class="workspace">
        <div class="workspace-header">
            <img src="pages/image/Rectangle.png" class="avatar">
            <div>
                <div class="workspace-name">
                    Workspace name
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
                Project Name
            </div>
            <div class="project-container">
                <div class="list-item" draggable="true">
                    <div class="block-select">
                        <div class="block-wall"></div>
                        <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">Value</textarea>
                    </div>
                    <div class="cards">
                        <div class="card-item" draggable="true">
                            Hello
                        </div>
                        <div class="card-item" draggable="true">
                            Card 2
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                    </div>
                </div>
                <div class="list-item" draggable="true">
                    <div class="block-select">
                        <div class="block-wall"></div>
                        <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">Value</textarea>
                    </div>
                    <div class="cards">
                        <div class="card-item" draggable="true">
                            Hello
                        </div>
                        <div class="card-item" draggable="true">
                            Card 2
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                    </div>
                </div>
                <div class="list-item" draggable="true">
                    <div class="block-select">
                        <div class="block-wall"></div>
                        <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">Value</textarea>
                    </div>
                    <div class="cards">
                        <div class="card-item" draggable="true">
                            Hello
                        </div>
                        <div class="card-item" draggable="true">
                            Card 2
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                    </div>
                </div>
                <div class="list-item" draggable="true">
                    <div class="block-select">
                        <div class="block-wall"></div>
                        <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">Value</textarea>
                    </div>
                    <div class="cards">
                        <div class="card-item" draggable="true">
                            Hello
                        </div>
                        <div class="card-item" draggable="true">
                            Card 2
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                    </div>
                </div>
                <div class="list-item" draggable="true">
                    <div class="block-select">
                        <div class="block-wall"></div>
                        <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">Value</textarea>
                    </div>
                    <div class="cards">
                        <div class="card-item" draggable="true">
                            Hello
                        </div>
                        <div class="card-item" draggable="true">
                            Card 2
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                    </div>
                </div>
                <div class="list-item" draggable="true">
                    <div class="block-select">
                        <div class="block-wall"></div>
                        <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">Value</textarea>
                    </div>
                    <div class="cards">
                        <div class="card-item" draggable="true">
                            Hello
                        </div>
                        <div class="card-item" draggable="true">
                            Card 2
                        </div>
                        <div class="card-item" draggable="true">
                            Card 3
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="block-background">
        <div class="card-form">
        </div>
    </div> -->

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
</body>

</html>