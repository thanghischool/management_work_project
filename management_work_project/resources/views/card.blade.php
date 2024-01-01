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
        $datetime1 = Carbon::parse('2023/12/30T23:32');
        $datetime2 = Carbon::now();
        $interval = $datetime1->diffInDays($datetime2);
        // // Calculate the difference
        // if($datetime1->lt($datetime2)) {
        //     echo "Hehe";
        // }
        echo Carbon::now()->format('Y-m-d\Th:i');
        echo $interval;
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
                <div>
                    <div class="modal__header">
                        <i class="fa-solid fa-window-maximize fa-lg" style="color: #000000;"></i>
                        <div class="name">
                            <h4 contenteditable="true" class="asd">NameCard</h4>
                            <p>Trong danh sánh ...</p>
                        </div>

                        <i class="fa-solid fa-xmark fa-lg" style="color: #000000; cursor: pointer;"></i>
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
                            <div class="slide checklist">
                                <div class="slide-header">
                                    <div class="name">
                                        <i class="fa-solid fa-clipboard-check fa-lg"></i>
                                        <h4>To do list</h4>
                                    </div>
                                    <button class="btnn">Delete</button>

                                </div>
                                <div class="slide-body">
                                    <div class="check">
                                        <input type="checkbox">
                                        <p class="check-content">Thắng code phần chức năng của Workspace như sau show dữ
                                            liệu ra workspace view, thêm sửa xóa 1 workspace. ngoài ra còn các tính năng
                                            liên quan đến workspace như mời bạn tham gia vào 1 group th</p>
                                    </div>
                                    <div class="slide-body">
                                        <textarea name="" id="" cols="50" rows="4" placeholder="Thêm mô tả chi tiết ..."></textarea>
                                    </div>
                                </div>
                                <div class="slide todolist hide">
                                    <div class="slide-header">
                                        <div class="name">
                                            <i class="fa-solid fa-clipboard-check fa-lg"></i>
                                            <h4>To do list</h4>
                                        </div>
                                        <button class="btnn closetodolist">Delete</button>

                                    </div>
                                    <div class="slide-body">
                                        <div class="check">
                                            <input type="checkbox">
                                            <p class="check-content">Thắng code phần chức năng của Workspace như sau
                                                show dữ liệu ra workspace view, thêm sửa xóa 1 workspace. ngoài ra còn
                                                các tính năng liên quan đến workspace như mời bạn tham gia vào 1 group
                                                th</p>
                                        </div>
                                        <div class="check">
                                            <input type="checkbox">
                                            <p class="check-content">Thắng code phần chức năng của Workspace như sau
                                                show dữ liệu ra workspace view, thêm sửa xóa 1 workspace. ngoài ra còn
                                                các tính năng liên quan đến workspace như mời bạn tham gia vào 1 group
                                                th</p>
                                        </div>
                                        <div class="check">
                                            <input type="checkbox">
                                            <p class="check-content">Thắng code phần chức năng của Workspace như sau
                                                show dữ liệu ra workspace view, thêm sửa xóa 1 workspace. ngoài ra còn
                                                các tính năng liên quan đến workspace như mời bạn tham gia vào 1 group
                                                th</p>
                                        </div>
                                        <button class="btnn addcheck-btn">Add</button>
                                        <ul class="addcheck hide">
                                            <li><input type="text" placeholder="Add an item" name="addcheck"
                                                    class="addcheck-content"></li>
                                            <li>
                                                <div style="display: flex"><button
                                                        class="btnn closeaddcheck cancel">Cancel</button><button
                                                        type="submit" class="btnn addcheck-btn-ss">Add</button></div>
                                            </li>

                                        </ul>
                                    </div>
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
                                        <p>Name:</p> <input type="text" name="nameTodolist">
                                    </li>
                                    <li><button class="btnn closetodolist-popup cancel">Cancel</button><button
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
        </div>

</body>
<script src="pages/test.js"></script>
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

</html>
