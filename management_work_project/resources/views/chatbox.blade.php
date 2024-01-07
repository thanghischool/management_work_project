<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <base href="{{ asset('') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="workspace_ID" content="{{ $workspace->id }}">
    <meta name="updateworkspaceurl" content="{{ route('update_Workspace', ['workspace' => $workspace->id]) }}">
    <link rel="stylesheet" href="pages/style.css" />
    <link rel="stylesheet" href="pages/chatBox.css" />
    @vite(['resources/js/bootstrap.js'])
</head>

<body>
    @include('layouts.header')
    <div class="body">
        <div class="folders">
            @include('sidebar.folder')
        </div>
        <div class="workspace">
            <div class="workspace-header">
                <img src="pages/image/Rectangle.png" class="avatar" />
                <div>
                    <div class="workspace-name">
                        <span id="workspace-name" title="{{ $workspace->name }}">
                            {{ $workspace->name }}
                        </span>
                        <button class="edit">
                            <img src="pages/image/pencil.png" />
                        </button>
                    </div>
                </div>
            </div>
            <div class="_container">
                <div class="title">
                    <img src="pages/image/arrow_down.png"
                        style="transform: rotate(90deg); height: fit-content; width: fit-content; cursor: pointer;"
                        onclick="window.location.href='{{ route('update_Workspace', ['workspace' => $workspace->id]) }}'">
                    <img src="pages/image/chatbox.png" />
                    Chat Box
                </div>
                <div class="chatbox">
                    <div class="chatbox-header">
                        <div class="right">
                            <img src="pages/image/phone.svg" alt="" />
                            <img src="pages/image/video.svg" alt="" />
                        </div>
                    </div>
                    <div class="chatbox-body">

                    </div>
                    <div class="chatbox-footer">
                        <img src="pages/image/microphone.svg" alt="" />
                        <input id="message" type="text" placeholder="Write your message" />
                        <div>
                            <img id="submit-message" src="pages/image/sendbutton.svg">
                            <img src="pages/image/sticker.svg" alt="" />
                            <img src="pages/image/camera.svg" alt="" />
                            <img src="pages/image/attachment.svg" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.user_ID = {{ Auth::id() }};
        // let date = new Date(Date.now());
        // document.querySelector('.date').innerHTML = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
    </script>
    <script src="pages/script.js"></script>
    <script src="pages/editable.js"></script>
    <script src="pages/message.js" type="module"></script>
    <script type="module" src="{{ mix('resources/js/app.js') }}" defer></script>
</body>

</html>
