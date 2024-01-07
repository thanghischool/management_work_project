<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('pages/card.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/fontawesome-free-6.5.1-web/css/all.min.css') }}">
</head>

<body>
    <div class="popup">
        <?php
        use Carbon\Carbon;
        // $datetime1 = Carbon::parse('2023/12/27T23:32');
        // $datetime2 = Carbon::now();
        
        // // Calculate the difference
        // if($datetime1->lt($datetime2)) {
        //     echo "Hehe";
        // }
        echo Carbon::now()->format('Y-m-d\Th:i');
        // echo $interval->format('%d days, %h hours, %i minutes, %s seconds');
        ?>
        <label for="party">Enter a date and time for your party booking:</label>
        <input id="party" type="datetime-local" name="partydate" min="<?php echo Carbon::now()->format('Y-m-d\Th:i'); ?>"
            value="<?php echo Carbon::now()->format('Y-m-d\Th:i'); ?>" />
        <p>{{ Auth::user()->name }}</p>
        <p>{{ Auth::user()->email }}</p>
        <p>{{ Auth::user()->id }}</p>
        <p>{{ session('id_user') }}</p>
        <a href="{{ route('logout') }}">logut</a>
        <button class="open-modal-btn">Card</button>
        <div class="modal hide">
            <div class="modal__inner">
                <div style="
                position: relative;
            ">
                    <div class="modal__header">
                        <i class="fa-solid fa-window-maximize fa-lg" style="color: #000000;"></i>
                        <div class="name">
                            <h4 contenteditable="true" class="asd">NameCard</h4>
                            <p>Trong danh sánh ...</p>
                        </div>

                        <i class="fa-solid fa-xmark fa-lg"
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
                                    <textarea name="" id="" cols="50" rows="4" placeholder="Thêm mô tả chi tiết ..."></textarea>
                                </div>
                            </div>
                            <div id="checklist-container">
                                {{-- <div class="slide todolist">
                                    <div class="slide-header">
                                        <div class="name">
                                            <i class="fa-solid fa-clipboard-check fa-lg"></i>
                                            <h4 contenteditable="true">To do list</h4>
                                        </div>
                                        <button class="btnn closetodolist">Delete</button>
                                    </div>
                                    <div class="slide-body">
                                        <div>
                                            <div class="check">
                                                <input type="checkbox">
                                                <p class="check-content">dsd</p>
                                                <button class="btnn cancel">Delete</button>
                                            </div>
                                            <div style="margin-left: 40px;">
                                                <input type="datetime-local" name="overdue">
                                                <ul class="users"
                                                    style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                                                    <li class="user-group">
                                                        <input type="checkbox" name="users[]" value="user1"
                                                            class="hide">
                                                        <img style="height: 20px; width: 20px" title="user"
                                                            src="https://scontent.fdad3-3.fna.fbcdn.net/v/t39.30808-6/413866646_1863469224107807_7628840190467076796_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeGjVGNGruhlrts83orP0fiXfbRlxLWm-419tGXEtab7jSJvaYYw4WkJ7pNM_pIFqx48TjXnOG-c7i2p6Z196bV9&_nc_ohc=98brBe4YHVUAX_AraAy&_nc_zt=23&_nc_ht=scontent.fdad3-3.fna&oh=00_AfB3rb0eNYvAN9u1oBEqv_G9euP-afkdlKB1JtzmQrisZg&oe=659BCBE7">
                                                    </li>
                                                    <li class="user-group">
                                                        <input type="checkbox" name="users[]" value="user1"
                                                            class="hide">
                                                        <img style="height: 20px; width: 20px" title="user"
                                                            src="https://scontent.fdad3-3.fna.fbcdn.net/v/t39.30808-6/413866646_1863469224107807_7628840190467076796_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeGjVGNGruhlrts83orP0fiXfbRlxLWm-419tGXEtab7jSJvaYYw4WkJ7pNM_pIFqx48TjXnOG-c7i2p6Z196bV9&_nc_ohc=98brBe4YHVUAX_AraAy&_nc_zt=23&_nc_ht=scontent.fdad3-3.fna&oh=00_AfB3rb0eNYvAN9u1oBEqv_G9euP-afkdlKB1JtzmQrisZg&oe=659BCBE7">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <button class="btnn addcheck-btn">Add</button>
                                        <ul class="addcheck">
                                            <li>
                                                <input type="text" placeholder="Add an item" name="addcheck"
                                                    class="addcheck-content">
                                                <div style="display: flex; flex-direction: column;">
                                                    <span class="input-task-header">overdue</span>
                                                    <input type="datetime-local" name="overdue">
                                                    <span class="input-task-header">Who will do this task ?</span>
                                                    <ul class="users"
                                                        style="display: flex; flex-wrap: wrap; gap: 10px">
                                                        <li class="user-group">
                                                            <input type="checkbox" name="users[]" value="user1">
                                                            <img title="user"
                                                                src="https://scontent.fdad3-3.fna.fbcdn.net/v/t39.30808-6/413866646_1863469224107807_7628840190467076796_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeGjVGNGruhlrts83orP0fiXfbRlxLWm-419tGXEtab7jSJvaYYw4WkJ7pNM_pIFqx48TjXnOG-c7i2p6Z196bV9&_nc_ohc=98brBe4YHVUAX_AraAy&_nc_zt=23&_nc_ht=scontent.fdad3-3.fna&oh=00_AfB3rb0eNYvAN9u1oBEqv_G9euP-afkdlKB1JtzmQrisZg&oe=659BCBE7">
                                                        </li>
                                                        <li class="user-group">
                                                            <input type="checkbox" name="users[]" value="user1">
                                                            <img title="user"
                                                                src="https://scontent.fdad3-3.fna.fbcdn.net/v/t39.30808-6/413866646_1863469224107807_7628840190467076796_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeGjVGNGruhlrts83orP0fiXfbRlxLWm-419tGXEtab7jSJvaYYw4WkJ7pNM_pIFqx48TjXnOG-c7i2p6Z196bV9&_nc_ohc=98brBe4YHVUAX_AraAy&_nc_zt=23&_nc_ht=scontent.fdad3-3.fna&oh=00_AfB3rb0eNYvAN9u1oBEqv_G9euP-afkdlKB1JtzmQrisZg&oe=659BCBE7">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div style="display: flex"><button
                                                        class="btnn closeaddcheck cancel">Cancel</button><button
                                                        type="submit" class="btnn addcheck-btn-ss">Add</button></div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> --}}
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
                                <li><button class="btnn closetodolist-popup cancel">Cancel</button><button
                                        type="submit" class="btnn addtodolist-btn">Add</button></li>
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
    </div>

</body>
<script>
    async function logMovies(overdue) {
        const response = await fetch("http://127.0.0.1:8000/api/workspaces/1/checklists/1", {
            method: "POST", // or 'PUT'
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                content: "test task",
                user_IDs: [1, 2, 3],
                overdue: overdue,
            })
        });
        const movies = await response.json();
        console.log(movies);
    }

    document.getElementById("party").onchange = (e) => {
        var date = e.target.value;
        var dateInput = new Date(Number(date.substring(0, 4)), Number(date.substring(5, 7)) - 1,
            Number(date.substring(8, 10)), Number(date.substring(11, 13)),
            Number(date.substring(14, 16)));;
        console.log(date);
        logMovies(date);
    }
</script>
<script src="{{ asset('pages/card.js') }}"></script>
<script src="pages/checklist.js"></script>

</html>
