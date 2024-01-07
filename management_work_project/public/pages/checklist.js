window.users = window.users.map(function (user) {
    return {
        user_ID: user.id,
        username: user.name,
        avatar: user.avatar
    }
});
function newTaskInputElement(content, datetime){
    const input = document.createElement('ul');
    input.className = "addcheck";
    input.innerHTML = `<li><input type="text" placeholder="Add an item" name="addcheck" value="${content}" class="addcheck-content"></li>
    <div style="display: flex; flex-direction: column; gap: 5px;">
        <span class="input-task-header">overdue</span>
        <input type="datetime-local" name="overdue" min="${new Date().toISOString().substring(0,16)}" value="${datetime}">
        <span class="input-task-header">Who will do this task ?</span>
        <ul class="users"
            style="display: flex; flex-wrap: wrap; gap: 10px">
        </ul>
    </div>
    <li>
        <div style="display: flex">
            <button class="btnn closeaddcheck cancel">Cancel</button>
            <button type="submit" class="btnn addcheck-btn-ss">Add</button>
        </div>
    </li>
    `;
    return input;
}
function replaceTaskElementToForm(taskElement, input, users){
    taskElement.parentElement.replaceChild(input, taskElement);
    menberGroup(window.users, input);
    users.forEach((user) => {
        let userImg = input.querySelector(`img[user_id="${user.user_ID}"]`);
        userImg.classList.add("selected");
        userImg.previousElementSibling.checked = true;
    });
    let cancelBtn = input.querySelector('.cancel');
    let addBtn = input.querySelector('.addcheck-btn-ss');
    let taskInput = input.querySelector('.addcheck-content');
    cancelBtn.onclick = () => {
        // trả về item cũ
        input.parentElement.replaceChild(taskElement, input);
    };
    addBtn.onclick = () => {
        // trả về item mới với content mới
        if (taskInput.value != "") {
            let overdue = input.querySelector('input[type="datetime-local"]');
            function getPickedUserIDS(){
                return Array.from(input.querySelectorAll('.user-group')).filter(function (value) {
                    return value.querySelector('input[type="checkbox"]').checked;
                }).map(function (value) {
                    const img = value.querySelector('img');
                    return img.getAttribute('user_ID');
                });
            }
            modifyTaskFetch(taskElement.id, taskInput.value, getPickedUserIDS(), overdue.value);
            // Gọi API sửa task gòm có task id,...
            //addTaskFetch(checklist.id, taskInput.value, getPickedUserIDS(), overdue.value);
            // truyền vô id cũ
            // replace không phải insert
            input.parentElement.replaceChild(newTaskElement(taskElement.id, taskInput.value, overdue.value,
                Array.from(input.querySelectorAll('.user-group')).filter(function (value) {
                    return value.querySelector('input[type="checkbox"]').checked;
                }).map(function (value) {
                    const img = value.querySelector('img');
                    return {
                        username: img.title,
                        avatar: img.src,
                        user_ID: img.getAttribute('user_ID')
                    }
                })
            ), input);
            cancelBtn.click();
        } else {
            cancelBtn.click();
        }
    }
}
function applyCardOpenable() {
    const cards = Array.from(document.querySelectorAll('.card-item'));
    cards.forEach(function (card) {
        card.onclick = openFormCard;
    });
}
applyCardOpenable();
function applyCardCloseable(){
    const cardForm = document.querySelector('.modal');
    const closeBtn = document.querySelector('.close-cardform');
    closeBtn.onclick = () => {
        cardForm.classList.add('hide');
    }
}
applyCardCloseable();
function openFormCard(e) {
    let container = document.querySelector('.modal.hide');
    container.id = e.target.id;
    getCardFetch(e.target.id);

}
function menberGroup(users, input) {
    const usersContainer = input.querySelector('.addcheck .users');
    users.forEach((user) => {
        usersContainer.append(newUserCheckBoxElement(user.user_ID,
            user.avatar,
            user.username));
    });
}

function todolistOpenBtn() {
    var opentodolist_popup = document.querySelector('.open-todolist-btn')
    var todolist_popup = document.querySelector('.todolist-popup')
    var closetodolist_popup = document.querySelector('.closetodolist-popup');
    const addBtn = todolist_popup.querySelector('.addtodolist-btn');
    const checklistInput = todolist_popup.querySelector('.nameTodolist');
    addBtn.onclick = (e) => {
        if (checklistInput.value != "") {
            // addChecklistFetch
            addChecklistFetch(document.querySelector('.modal').id, checklistInput.value);
            renderNewCheckList(checklistInput.value);
            checklistInput.value = "";
            toggletodolist_popup();
        } else {
            checklistInput.focus();
            Object.assign(checklistInput.style, {
                border: "1px solid red",
                outline: "1px solid red",
            })
        }
    }
    function toggletodolist_popup(e) {
        todolist_popup.classList.toggle('hide')
        Object.assign(todolist_popup.style, {
            top: e?.clientY + 'px',
            left: e?.clientX + 'px',
            position: "fixed"
        });
    }
    opentodolist_popup.addEventListener('click', toggletodolist_popup);
    closetodolist_popup.addEventListener('click', toggletodolist_popup)
}
todolistOpenBtn();
function newUserCheckBoxElement(user_ID, avatar, username) {
    const element = document.createElement('li');
    element.className = 'user-group';
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.className = 'hide';
    checkbox.checked = false;
    const img = document.createElement('img');
    img.title = username;
    img.setAttribute('user_ID', user_ID);
    img.src = avatar;
    element.appendChild(checkbox);
    element.appendChild(img);
    img.onclick = (e) => {
        console.log(checkbox.checked);
        if (checkbox.checked == false) {
            img.classList.add('selected');
            checkbox.checked = true;
        } else {
            img.classList.remove('selected');
            checkbox.checked = false;
        }
    }
    return element;
}
function newTaskElement(id = "", content, datetime, users) {
    const item = document.createElement('div');
    item.id = id;
    const taskElement = document.createElement('div');
    taskElement.className = "check";
    taskElement.innerHTML = `<input type="checkbox">`;
    item.appendChild(taskElement);
    // content Element
    const taskContentInput = document.createElement('p');
    taskContentInput.className = "check-content";
    taskContentInput.contentEditable = true;
    taskContentInput.innerHTML = content;
    let oldvalue;
    taskContentInput.onfocus = () => {
        oldvalue = taskContentInput.innerText;
        // taskElement = taskContentInput.parentElement.parentElement;
        // taskElement.parentElement.replaceChild(newTaskInputElement(taskContentInput.innerText, ), taskElement);
        replaceTaskElementToForm(item, newTaskInputElement(taskContentInput.innerText, item.querySelector('input[type="datetime-local"]')?.value), users)
    }
    taskContentInput.onblur = () => {
        if (taskContentInput.innerText == "") {
            taskContentInput.innerHTML = oldvalue;
        } else {
            // goi api thay doi content cua task

        }
    }

    // deleteElement
    const deleteElement = document.createElement('button');
    deleteElement.className = "btnn cancel";
    deleteElement.innerHTML = "Delete";
    deleteElement.onclick = function () {
        taskElement.parentElement.parentElement.removeChild(taskElement.parentElement);
        deleteTaskFetch(taskElement.parentElement.id);
    }

    taskElement.appendChild(taskContentInput);
    taskElement.appendChild(deleteElement);

    let userString = users.map((user) => {
        return `
        <li class="user-group">
            <input type="checkbox" name="users[]" value="${user.user_ID}" class="hide">
            <img style="height: 20px; width: 20px" title="${user.username}" src="${user.avatar}">
        </li>`;
    }).join('\n');
    const moreElement = document.createElement('div');
    moreElement.style = "margin-left: 40px";
    if (datetime != "" && datetime != null) {
        moreElement.innerHTML += `
        <input type="datetime-local" name="overdue" value="${datetime}">`
    }
    moreElement.innerHTML += `
    <ul class="users" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
        ${userString}
    </ul>`;
    item.appendChild(moreElement);
    // lắng nghe người dùng sửa user
    const usersBtn = moreElement.querySelector('users');
    return item;
}
function renderCheckLists(id ,title, tasks) {
    const checkList = document.createElement('div');
    checkList.id = id;
    checkList.className = "slide todolist";
    checkList.innerHTML = `
    <div class="slide-header">
        <div class="name">
            <i class="fa-solid fa-clipboard-check fa-lg"></i>
            <h4 contenteditable="true" class="checklist-title">${title}</h4>
        </div>
        <button class="btnn closetodolist">Delete</button>
    </div>
    <div class="slide-body">
        <button class="btnn addcheck-btn">Add</button>
    </div>`;
    // Form input task
    const input = document.createElement('ul');
    input.className = "addcheck";
    input.innerHTML = `<li><input type="text" placeholder="Add an item" name="addcheck" class="addcheck-content"></li>
    <div style="display: flex; flex-direction: column; gap: 5px;">
        <span class="input-task-header">overdue</span>
        <input type="datetime-local" name="overdue" min="${new Date().toISOString().substring(0,16)}">
        <span class="input-task-header">Who will do this task ?</span>
        <ul class="users"
            style="display: flex; flex-wrap: wrap; gap: 10px">
        </ul>
    </div>
    <li>
        <div style="display: flex">
            <button class="btnn closeaddcheck cancel">Cancel</button>
            <button type="submit" class="btnn addcheck-btn-ss">Add</button>
        </div>
    </li>
    `;
    document.getElementById('checklist-container').appendChild(checkList);


    // xu ly event cua title checklist
    let oldTitleValue;
    const inputChecklistTitle = checkList.querySelector('.checklist-title');
    inputChecklistTitle.onfocus = () => {
        oldTitleValue = inputChecklistTitle.innerHTML;
    };
    inputChecklistTitle.onblur = function () {
        if (inputChecklistTitle.innerHTML != "") {
            // goi api doi title check list
            modifyChecklistFetch(checkList.id, inputChecklistTitle.innerHTML);
        } else inputChecklistTitle.innerHTML = oldTitleValue;
    };


    //xu ly event khi delete element
    checkList.querySelector('.btnn.closetodolist').onclick = () => {
        checkList.parentElement.removeChild(checkList);
        // Goi API xoa checklist
        deleteChecklistFetch(checkList.id);
    };
    const body = checkList.querySelector('.slide-body');
    const addTaskBtn = body.querySelector('.addcheck-btn');
    // render tat ca cac tasks
    tasks.forEach((task) => {
        body.insertBefore(newTaskElement(task.id, task.content, task.overdue,
            task.users.map((user) => {
                return {
                    user_ID: user.id,
                    username: user.name,
                    avatar: user.avatar,
                }
            })
        ), body.lastElementChild);
    });


    const usersContainer = input.querySelector('.users');

    // Xu ly event khi nhan add task
    let cancelBtn;
    let addBtn;
    let taskInput;
    addTaskBtn.onclick = () => {
        body.replaceChild(input, addTaskBtn);
        menberGroup(window.users, input);
        if (!cancelBtn) cancelBtn = input.querySelector('.cancel');
        if (!addBtn) addBtn = input.querySelector('.addcheck-btn-ss');
        if (!taskInput) taskInput = input.querySelector('.addcheck-content');
        cancelBtn.onclick = () => {
            taskInput.value = "";
            usersContainer.innerHTML = "";
            input.querySelector('input[type="datetime-local"]').value = "";
            body.replaceChild(addTaskBtn, input);
        };
        addBtn.onclick = () => {
            if (taskInput.value != "") {
                let overdue = input.querySelector('input[type="datetime-local"]');
                function getPickedUserIDS(){
                    return Array.from(input.querySelectorAll('.user-group')).filter(function (value) {
                        return value.querySelector('input[type="checkbox"]').checked;
                    }).map(function (value) {
                        const img = value.querySelector('img');
                        console.log(img.getAttribute('user_ID'));
                        return img.getAttribute('user_ID');
                    });
                }
                let checklist = input.parentElement.parentElement;
                // fetch them 1 task co content la taskInput.value
                console.log(getPickedUserIDS());
                addTaskFetch(checklist.id, taskInput.value, getPickedUserIDS(), overdue.value);
                body.insertBefore(newTaskElement("task-pending",taskInput.value, overdue.value,
                    Array.from(input.querySelectorAll('.user-group')).filter(function (value) {
                        return value.querySelector('input[type="checkbox"]').checked;
                    }).map(function (value) {
                        const img = value.querySelector('img');
                        return {
                            username: img.title,
                            avatar: img.src,
                            user_ID: img.getAttribute('user_ID')
                        }
                    })
                ), body.lastElementChild);
                cancelBtn.click();
            } else {
                cancelBtn.click();
            }
        }
    }
}

function renderNewCheckList(title) {
    const checkList = document.createElement('div');
    checkList.className = "slide todolist pending";
    checkList.innerHTML = `
    <div class="slide-header">
        <div class="name">
            <i class="fa-solid fa-clipboard-check fa-lg"></i>
            <h4 contenteditable="true" class="checklist-title">${title}</h4>
        </div>
        <button class="btnn closetodolist">Delete</button>
    </div>
    <div class="slide-body">
        <button class="btnn addcheck-btn">Add</button>
    </div>`;
    const input = document.createElement('ul');
    input.className = "addcheck";
    input.innerHTML = `<li><input type="text" placeholder="Add an item" name="addcheck" class="addcheck-content"></li>
    <div style="display: flex; flex-direction: column; gap: 5px;">
        <span class="input-task-header">overdue</span>
        <input type="datetime-local" name="overdue" min="${new Date().toISOString().substring(0,16)}">
        <span class="input-task-header">Who will do this task ?</span>
        <ul class="users"
            style="display: flex; flex-wrap: wrap; gap: 10px">
        </ul>
    </div>
    <li>
        <div style="display: flex">
            <button class="btnn closeaddcheck cancel">Cancel</button>
            <button type="submit" class="btnn addcheck-btn-ss">Add</button>
        </div>
    </li>
    `;
    document.getElementById('checklist-container').appendChild(checkList);


    // xu ly event cua title checklist
    let oldTitleValue;
    const inputChecklistTitle = checkList.querySelector('.checklist-title');
    inputChecklistTitle.onfocus = () => {
        oldTitleValue = inputChecklistTitle.innerHTML;
    };
    inputChecklistTitle.onblur = function () {
        if (inputChecklistTitle.innerHTML != "") {
            // goi api doi title check list

        } else inputChecklistTitle.innerHTML = oldTitleValue;
    };


    //xu ly event khi delete element
    checkList.querySelector('.btnn.closetodolist').onclick = () => {
        checkList.parentElement.removeChild(checkList);
        // Goi API xoa checklist
        deleteChecklistFetch(checkList.id);
    };
    const body = checkList.querySelector('.slide-body');
    const addTaskBtn = body.querySelector('.addcheck-btn');


    const usersContainer = input.querySelector('.users');

    // Xu ly event khi nhan add task
    let cancelBtn;
    let addBtn;
    let taskInput;
    addTaskBtn.onclick = () => {
        let overdue = input.querySelector('input[type="datetime-local"]');
        body.replaceChild(input, addTaskBtn);
        menberGroup(window.users, input);
        if (!cancelBtn) cancelBtn = input.querySelector('.cancel');
        if (!addBtn) addBtn = input.querySelector('.addcheck-btn-ss');
        if (!taskInput) taskInput = input.querySelector('.addcheck-content');
        cancelBtn.onclick = () => {
            taskInput.value = "";
            usersContainer.innerHTML = "";
            overdue.value = "";
            body.replaceChild(addTaskBtn, input);
        };
        addBtn.onclick = () => {
            if (taskInput.value != "") {
                function getPickedUserIDS(){
                    return Array.from(input.querySelectorAll('.user-group')).filter(function (value) {
                        return value.querySelector('input[type="checkbox"]').checked;
                    }).map(function (value) {
                        const img = value.querySelector('img');
                        return img.getAttribute('user_ID');
                    });
                }
                let checklist = input.parentElement.parentElement;
                console.log(getPickedUserIDS());
                // fetch them 1 task co content la taskInput.value
                addTaskFetch(checklist.id, taskInput.value, getPickedUserIDS(), overdue.value);
                body.insertBefore(newTaskElement("task-pending", taskInput.value, input.querySelector('input[type="datetime-local"]').value,
                    Array.from(input.querySelectorAll('.user-group')).filter(function (value) {
                        return value.querySelector('input[type="checkbox"]').checked;
                    }).map(function (value) {
                        const img = value.querySelector('img');
                        return {
                            username: img.title,
                            avatar: img.src,
                            user_ID: img.getAttribute('user_ID')
                        }
                    })
                ), body.lastElementChild);
                cancelBtn.click();
            } else {
                cancelBtn.click();
            }
        }
    }
}
async function addChecklistFetch(card_ID, title) {
    const response = await fetch(window.webURL+"api/checklist", {
        method: "POST", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            card_ID: card_ID,
            title: title,
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    const checklistE = document.querySelector('.todolist.pending');
    checklistE.id = result.id;
    checklistE.classList.remove('pending');
    console.log(result);
}
async function modifyChecklistFetch(id, title) {
    const response = await fetch(window.webURL+"api/checklist/" + id, {
        method: "PUT", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            title: title,
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
}
async function deleteChecklistFetch(id) {
    const response = await fetch(window.webURL+"api/checklist/" + id, {
        method: "delete", 
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
}

async function addTaskFetch(checklist_ID, content, user_IDs, overdue) {
    const response = await fetch(window.webURL+"api/checklist/"+checklist_ID+"/task", {
        method: "POST", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            workspace_ID: window.workspace_ID,
            checklist_ID,
            user_IDs,
            overdue,
            content,
        })
    });
    const result = await response.json();
    console.log(result);
    const task = document.getElementById('task-pending');
    if(result.task){
        task.id = result.task.id;
    } else {
        task.id = "";
    }
}
async function modifyTaskFetch(id, content, user_IDs, overdue) {
    const response = await fetch(window.webURL+"api/task/" + id, {
        method: "PUT", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            workspace_ID: window.workspace_ID,
            user_IDs,
            overdue,
            content,
        })
    });
    const result = await response.json();
    console.log(result);
}
async function deleteTaskFetch(id) {
    const response = await fetch(window.webURL+"api/task/" + id, {
        method: "DELETE", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
}
console.log(window.workspace_ID);
async function getCardFetch(id) {
    const response = await fetch(window.webURL+"api/" + document.querySelector('meta[name="workspace_ID"]').getAttribute('content') + "/card/" + id, {
        method: "GET", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    });
    const result = await response.json();
    console.log(result);
    let container = document.querySelector('.modal.hide');
    container.classList.remove('hide');
    const cardName = container.querySelector('#card-name');
    const description = container.querySelector('#description');
    const checklistContainer = container.querySelector('#checklist-container');
    cardName.innerText = result.title;
    description.value = result.description;
    result.checklists.forEach((checklist) => {
        renderCheckLists(checklist.id, checklist.title, checklist.tasks);
    })
}
