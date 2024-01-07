function todolistOpenBtn(){
    var opentodolist_popup = document.querySelector('.open-todolist-btn')
    var todolist_popup = document.querySelector('.todolist-popup')
    var closetodolist_popup = document.querySelector('.closetodolist-popup');
    const addBtn = todolist_popup.querySelector('.addtodolist-btn');
    const checklistInput = todolist_popup.querySelector('.nameTodolist');
    addBtn.onclick = (e) => {
        if(checklistInput.value != "") {
            renderNewCheckList(checklistInput.value);
            checklistInput.value = "";
            toggletodolist_popup();
        }
    }
    function toggletodolist_popup(e){
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
function renderNewCheckList(value){
    const checkList = document.createElement('div');
    checkList.className = "slide todolist";
    checkList.innerHTML = `
    <div class="slide-header">
        <div class="name">
            <i class="fa-solid fa-clipboard-check fa-lg"></i>
            <h4>${value}</h4>
        </div>
        <button class="btnn closetodolist">Delete</button>
    </div>
    <div class="slide-body">
        <button class="btnn addcheck-btn">Add</button>
    </div>`;
    const input = document.createElement('ul');
    input.className = "addcheck";
    input.innerHTML = `<li><input type="text" placeholder="Add an item" name="addcheck" class="addcheck-content"></li>
    <li>
        <div style="display: flex">
            <button class="btnn closeaddcheck cancel">Cancel</button>
            <button type="submit" class="btnn addcheck-btn-ss">Add</button>
        </div>
    </li>`;
    document.getElementById('checklist-container').appendChild(checkList);
    checkList.querySelector('.btnn.closetodolist').onclick = () => {
        checkList.parentElement.removeChild(checkList);
        // Goi API xoa checklist
    };
    const body = checkList.querySelector('.slide-body');
    const addTaskBtn = body.querySelector('.addcheck-btn');
    function newTaskElement(value){
        const taskElement = document.createElement('div');
        taskElement.className = "check";
        taskElement.innerHTML = `<input type="checkbox">
        <p class="check-content">${value}</p>`;
        const deleteElement = document.createElement('button');
        deleteElement.className = "btnn cancel";
        deleteElement.innerHTML = "Delete";
        deleteElement.onclick = function(){
            taskElement.parentElement.removeChild(taskElement);
            // Goi API xoa task

        }
        taskElement.appendChild(deleteElement);
        return taskElement;
    }
    let cancelBtn;
    let addBtn;
    let taskInput;
    // thay thế nhau
    addTaskBtn.onclick = () => {
        body.replaceChild(input, addTaskBtn);
        if(!cancelBtn) cancelBtn = input.querySelector('.cancel');
        if(!addBtn) addBtn = input.querySelector('.addcheck-btn-ss');
        if(!taskInput) taskInput = input.querySelector('.addcheck-content');
        cancelBtn.onclick = () => {
            taskInput.value = "";
            body.replaceChild(addTaskBtn, input);
        };
        addBtn.onclick = () => {
            if (taskInput.value != ""){
                // fetch them 1 task

                body.insertBefore(newTaskElement(taskInput.value), body.lastElementChild);
                cancelBtn.click();
            } else {
                cancelBtn.click();
            }
        }
    }
}
renderNewCheckList("Hello");