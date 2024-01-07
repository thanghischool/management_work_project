
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('pages/card.css')}}">
    <link rel="stylesheet" href="{{asset('pages/fontawesome-free-6.5.1-web/css/all.min.css')}}">
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
        echo Carbon::now()->format("Y-m-d\Th:i");
        // echo $interval->format('%d days, %h hours, %i minutes, %s seconds');
        ?>
        <label for="party">Enter a date and time for your party booking:</label>
        <input
        id="party"
        type="datetime-local"
        name="partydate"
        min="<?php echo Carbon::now()->format("Y-m-d\Th:i"); ?>"
        value="<?php echo Carbon::now()->format("Y-m-d\Th:i"); ?>" />
        <p>{{Auth::user()->name}}</p>
        <p>{{Auth::user()->email}}</p>
        <p>{{Auth::user()->id}}</p>
        <p>{{ session('id_user') }}</p>
        <a href="{{route('logout')}}" >logut</a>
        <button class="open-modal-btn">Card</button>
        <div class="modal hide">
            <div class="modal__inner">
                    <div>
                        <div class="modal__header"> 
                            <i class="fa-solid fa-window-maximize fa-lg" style="color: #000000;"></i>
                            <div class="name">
                                <h4 contenteditable="true" class="asd" >NameCard</h4>
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
                                <div class="slide todolist hide">
                                    <div class="slide-header">
                                        <div class="name">
                                            <i class="fa-solid fa-clipboard-check fa-lg"></i>          
                                            <h4>To do list</h4>
                                        </div>      
                                        <button class="btnn closetodolist">Delete</button>
                                        
                                    </div>
                                    <div class="slide-body">
                                        <button class="btnn addcheck-btn">Add</button>    
                                        <ul class="addcheck hide">
                                                <li><input type="text" placeholder="Add an item" name="addcheck" class="addcheck-content"></li>
                                                <li><div style="display: flex"><button class="btnn closeaddcheck cancel">Cancel</button><button type="submit" class="btnn addcheck-btn-ss">Add</button></div></li>

                                        </ul>                                                                                        
                                    </div>
                                </div>
                                <div class="slide addfile">
                                    <div class="slide-header">
                                        <div class="name">
                                            <i class="fa-solid fa-folder-plus"></i>
                                            <h4>Add File</h4>
                                        </div>      
                                        <button class="btnn closeaddfile">Delete</button>
                                        
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
                                    <li><p>Name:</p> <input type="text" class="nameTodolist" name="nameTodolist"></li>
                                    <li><button class="btnn closetodolist-popup cancel">Cancel</button><button type="submit" class="btnn addtodolist-btn">Add</button></li>
                                </ul>
                                <button class="btnn open-addfile-btn">Add File</button> <br>
                                <ul class="subnav addfile-popup hide">
                                    <li>
                                        <p class="activity-name">Attach</p>
                                    </li>
                                    <li class="slect-file">
                                    <label for="myfile" style="width: 100%; display: block; height: 30px; background-color: rgb(241,242,244); text-align: center; line-height: 30px;">Select a file</label>
                                    <p class="message-error-file" style="color: red;"></p>
                                    <input type="file" id="myfile" name="myfile" style="display: none;"><br><br>
                                    </li>
                                    <li><p>Search for or paste a link</p> <input type="text" name="linkfile"></li>
                                    <li><div><button class="btnn closeaddfile-popup cancel">Cancel</button><button class="btnn addfile-btn">Add</button></div></li>
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
            const response = await fetch("http://127.0.0.1:8000/api/workspaces/1/checklists/1",{
                method: "POST", // or 'PUT'
                headers: {
                    'Accept':'application/json',
                    'Content-Type':'application/json',
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
            var dateInput = new Date(Number(date.substring(0, 4)), Number(date.substring(5, 7))-1, 
                Number(date.substring(8, 10)), Number(date.substring(11, 13)), 
                Number(date.substring(14, 16)));;
            console.log(date);
            logMovies(date);
        }
    </script>
    <script src="{{asset('pages/card.js')}}"></script>
    <script>
    async function uploadfile(e) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const file = e.target.files[0];
    const formData = new FormData();
    formData.append('file', file);
   
    try {
        const response = await fetch("http://127.0.0.1:8000/card/2/1", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData,
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data_return = await response.json();
        if(data_return.message) {
            console.log(data_return);
        // Handle data from the server
        let file_content = document.createElement('div');
        file_content.classList.add('addfile-content');
        file_content.setAttribute('id', `addfile-content-${data_return.id}`);

        let addfileSlide = document.querySelector(".modal__body .content .addfile");
        addfileSlide.appendChild(file_content);

        let add_file_content = document.getElementById(`addfile-content-${data_return.id}`);
        let extension_LowerCase = data_return.extension.toLowerCase();
        let extension_UperCase = data_return.extension.toUpperCase();
        let allowedExtensions = ['jpeg', 'png', 'jpg', 'gif'];

        if(allowedExtensions.includes(extension_LowerCase)) {
        add_file_content.innerHTML = ` 
                                    <div class="slide-body">
                                        <div class="cardfile ">
                                            <img src="{{asset('${data_return.link}')}}" alt="" class="fileimg">
                                            <div class="contentfile">
                                                <div class="namefile">
                                                    <h4 class="namefile">${data_return.nameFile}</h4>
                                                </div>
                                                <div class="descfile">
                                                    <p>30/12/2023</p>
                                                </div>
                                                <div class="btnfile">
                                                    <button class="btnn">Edit</button>
                                                </div>
                                            </div>
                                            <button class="btnn cancel" onclick="deletefile(${data_return.id})">Delete</button>
                                        </div>
                                        
                                        
                                        <button class="btnn addfilenew-btn">Add</button>
                                        <ul class="subnav addfilenew hide">
                                            <li><p>Search for or paste a link</p> <input type="text" class="addfile-content" name="linkfile"></li>
                                            <li><div><button class="btnn closeaddfilenew cancel">Cancel</button><button type="submit" class="btnn addfile-btn-ss">Add</button></div></li>
                                        </ul>                                                                           
                                    </div>`
        } else {
            add_file_content.innerHTML =          
                                ` 
                                    <div class="slide-body">
                                        <div class="cardfile ">
                                            <span class="fileimg" style="background-color: rgb(228,230,234); text-align: center; line-height: 80px">${extension_UperCase}</span>
                                            <div class="contentfile">
                                                <div class="namefile">
                                                    <h4 class="namefile">${data_return.nameFile}</h4>
                                                </div>
                                                <div class="descfile">
                                                    <p>30/12/2023</p>
                                                </div>
                                                <div class="btnfile">
                                                    <button class="btnn">Edit</button>
                                                </div>
                                            </div>
                                            <button class="btnn cancel" onclick="deletefile(${data_return.id})">Delete</button>
                                        </div>
                                        
                                        
                                        <button class="btnn addfilenew-btn">Add</button>
                                        <ul class="subnav addfilenew hide">
                                            <li><p>Search for or paste a link</p> <input type="text" class="addfile-content" name="linkfile"></li>
                                            <li><div><button class="btnn closeaddfilenew cancel">Cancel</button><button type="submit" class="btnn addfile-btn-ss">Add</button></div></li>
                                        </ul>                                                                           
                                    </div>`
        }
        
        }

    } catch (error) {
        console.error("Error:", error);
        // Handle errors here, display error message to the user, etc.
    }
}

document.getElementById("myfile").addEventListener('change', uploadfile, false);


</script>

<script type="module" >
function deletefile(fileID) {
    console.log("hello world");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`http://127.0.0.1:8000/card/${fileID}`, {
        method: "GET",
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
    })
    .then(response => {
        return response.json();
    })
    .then(message => {
        let addfile_content = document.getElementById(`addfile-content-${fileID}`);
        addfile_content.innerHTML = '';
    })
    .catch(error => {
        console.error("Error:", error);
    });
}
</script>
</html>