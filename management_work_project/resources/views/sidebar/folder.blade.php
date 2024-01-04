<div class="workspace-title">
    <h2>Workspaces</h2>
    <img src="pages/image/plus.png" alt="">
</div>
<div class="workspace-container">
    @if(isset($workspaces))
    @foreach($workspaces as $workspace)
    <div class="item" id="{{ $workspace->id }}" title="{{ $workspace->name }}">
        <img class="square" src="{{ $workspace->avatar }}">
        <h3>{{ $workspace->name }}</h3>
        <img class="arrow" src="pages/image/arrow_down.png" alt="">
    </div>
    @endforeach
    @endif
    <!-- <div class="item">
        <img class="square" src="pages/image/Rectangle.png">
        <h3>Workspace name</h3>
        <img class="arrow" src="pages/image/arrow_down.png" alt="">
    </div>
    <div class="item">
        <img class="square" src="pages/image/Rectangle.png">
        <h3>Workspace name</h3>
        <img class="arrow" src="pages/image/arrow_down.png" alt="">
    </div> -->
</div>