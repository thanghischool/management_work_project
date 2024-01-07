function reOrderIndex(itemSelector, containerSelector){
    const containers = document.querySelectorAll(containerSelector);
    containers.forEach((container) => {
        const items = container.querySelectorAll(itemSelector);
        items.forEach((item, index) => {
            item.setAttribute("index", index);
        });
    });
}
function applyEditableTitleToList(listQuery, titleQuery, blockwallQuery){
    lists = Array.from(document.querySelectorAll(listQuery));
    let span = document.getElementById("heightExpanded");
    if (!span) {
        span = document.createElement('span');
        span.style.setProperty('display','inline-block');
        span.id = "heightExpanded";
        span.style.setProperty('word-break','break-all');
        span.style.setProperty('font-size',2 + "rem");
        span.style.setProperty('font-weight', 'bold');  
        span.style.setProperty('font-family', 'Inter, sans-serif');
        span.style.setProperty('width', document.querySelector(titleQuery).offsetWidth + "px");
        span.style.setProperty('visibility', "hidden");
        span.style.setProperty('position', "fixed");
        span.style.setProperty('white-space','pre-wrap');
        document.body.appendChild(span);
    }
    lists.forEach(list => {
        const title = list.querySelector(titleQuery);
        const blockwall = list.querySelector(blockwallQuery);
        span.textContent = title.value;
        title.style.height = span.offsetHeight + 'px';
        blockwall.style.height = title.style.height;
        blockwall.onclick = (e) => {
            blockwall.style.visibility = "hidden";
            title.focus();
            title.select();
            const oldValue = title.value;
            title.onblur = (e1) => {
                blockwall.style.visibility = "visible";
                if(title.value.trim() === "" || title.value === oldValue) title.value = oldValue;
                else modifyListTitle(list.id, title.value.trim());
                console.log(title.value.trim());
            };
        }
        title.oninput = (e) => {
            // console.log(title.scrollHeight);
            // title.style.height = title.scrollHeight - 4 + 'px';
            // blockwall.style.height = title.style.height + 'px';
            span.textContent = title.value;
            blockwall.style.height = title.style.height;
            if(title.value.trim() !== "") title.style.height = span.offsetHeight + 'px';
        };
    });
}

function addListButton(){
    let addBtn = document.getElementById('addlistbtn');
    addBtn.addEventListener('click', function(e) {
        const div = document.createElement('div');
        div.id = "addlistform";
        div.innerHTML = `<textarea class="list-title" name="title" id="title" placeholder="title"></textarea>
        <div class="button" style="display: block">
            <svg class="close" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"></path></svg>
            <svg class="check" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>
        </div>`;
        addBtn.parentElement.replaceChild(div, addBtn);
        setTimeout(function() {
            const span = document.getElementById('heightExpanded');
            div.querySelector(".close").onclick = (e) => {
                div.parentElement.replaceChild(addBtn, div);
            };
            const textarea = div.querySelector('textarea');
            textarea.focus();
            textarea.oninput = (e) => {
                span.textContent = textarea.value;
                // blockwall.style.height = title.style.height;
                if(textarea.value.trim() !== "") textarea.style.height = span.offsetHeight + 'px';
            };
            div.querySelector(".check").onclick = (e) => {
                if(textarea.value.trim() !== "") {
                    // goi api tao moi 1 list
                    addListFetch(textarea.value);
                    div.parentElement.replaceChild(addBtn, div);
                }
            };
        }, 0);
    });
}
addListButton();

async function modifyListTitle(id, title){
    const response = await fetch(window.webURL+"api/lists/title/"+id,{
        method: "PUT", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            title: title,
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
}
async function addListFetch(title){
    const response = await fetch(window.webURL+"api/lists",{
        method: "POST", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            title: title,
            project_ID: document.querySelector('meta[name="project_ID"]').getAttribute("content"),
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
}
async function deleteListFetch(id){
    const response = await fetch(window.webURL+"api/lists/"+id,{
        method: "DELETE", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
}

function removeListItem(e){
    const listItem = e.target.parentElement;
    deleteListFetch(listItem.id);
    listItem.parentElement.removeChild(listItem);
    reOrderIndex(".list-item", ".project-container");
}
function applyDeleteListButtons(btnSelector){
    const deleteBtns = Array.from(document.querySelectorAll(btnSelector));
    deleteBtns.forEach(function(btnDelete) {
        btnDelete.onclick = removeListItem;
    });
}
applyDeleteListButtons(".deletelist-btn");

