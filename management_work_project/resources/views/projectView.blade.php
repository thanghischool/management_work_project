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
            <div class="list-item" draggable="true" id="{{ $column->id }}">
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