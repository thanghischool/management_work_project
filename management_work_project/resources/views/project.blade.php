<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="projectView.css">
</head>

<body>
    <div class="folders">
        <div class="workspace-title">
            <h2>Workspaces</h2>
            <img src="image/plus.png" alt="">
        </div>
        <div class="workspace-container">
            <div class="item">
                <img class="square" src="image/Rectangle.png">
                <h3>Workspace name</h3>
                <img class="arrow" src="image/arrow_down.png" alt="">
            </div>

            <div class="item">
                <img class="square" src="image/Rectangle.png">
                <h3>Workspace name</h3>
                <img class="arrow" src="image/arrow_down.png" alt="">
            </div>
            <div class="item">
                <img class="square" src="image/Rectangle.png">
                <h3>Workspace name</h3>
                <img class="arrow" src="image/arrow_down.png" alt="">
            </div>
        </div>
    </div>
    <div class="workspace">
        <div class="workspace-header">
            <img src="image/Rectangle.png" class="avatar">
            <div>
                <div class="workspace-name">
                    Workspace name
                    <button class="edit"><img src="image/pencil.png"></button>
                </div>
                <div class="ability">
                    <img src="image/Vector.png">
                    private
                </div>
            </div>
        </div>
        <div class="_container">
            <div class="title">
                <img src="image/arrow_down.png"
                    style="transform: rotate(90deg); height: fit-content; width: fit-content;">
                <img src="image/project-icon.png">
                Project Name
            </div>
            <div class="project-container">
                <div class="list-item" draggable="true">
                    <div class="block-select">
                        <div class="block-wall"></div>
                        <textarea class="list-title" name="" id="" cols="30" rows="10"
                            spellcheck="false">Value</textarea>
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
                        <textarea class="list-title" name="" id="" cols="30" rows="10"
                            spellcheck="false">Value</textarea>
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
                        <textarea class="list-title" name="" id="" cols="30" rows="10"
                            spellcheck="false">Value</textarea>
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
                        <textarea class="list-title" name="" id="" cols="30" rows="10"
                            spellcheck="false">Value</textarea>
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
                        <textarea class="list-title" name="" id="" cols="30" rows="10"
                            spellcheck="false">Value</textarea>
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
                        <textarea class="list-title" name="" id="" cols="30" rows="10"
                            spellcheck="false">Value</textarea>
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

    <script src="script.js"></script>
    <script src="dragable.js"></script>
    <script>
    applyDragableIntoList(".project-container", ".list-item");
    applyDragableIntoCard(".cards", ".card-item");
    </script>
    <script src="list.js"></script>
    <script>
    applyEditableTitleToList(".list-item", ".list-title", ".block-wall");
    </script>
    <script src="editable.js"></script>
</body>

</html>