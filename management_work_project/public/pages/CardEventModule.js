export function newCardElement(id, title, list_ID){
    const card = document.createElement("div");
    card.className = "card-item";
    card.draggable = "true";
    card.innerHTML = title;
    card.id = id;
    const list = document.querySelector('.list-item[id="'+list_ID+'"]');
    const cardcontainer = list.querySelector('.cards');
    cardcontainer.insertBefore(card, cardcontainer.lastElementChild);
    reOrderIndex(".card-item", ".cards");
    card.ondragstart = (e) => {
        // Adding dragging class to item after a delay
        e.stopPropagation();
        setTimeout(() => {
            card.classList.add("dragging");
        }, 0);
    };
    // Removing dragging class from item on dragend event
    card.ondragend = (e) => {
        e.stopPropagation();
        card.classList.remove("dragging");
        reOrderIndex(".card-item", ".cards");
        let list_ID = card.parentElement.parentElement.getAttribute("id");
        let index = card.getAttribute("index");
        let card_ID = card.getAttribute("id");
        modifyCardPosition(card_ID, index, list_ID);
    };
}
export function reOrderIndex(itemSelector, containerSelector){
    const containers = document.querySelectorAll(containerSelector);
    containers.forEach((container) => {
        const items = container.querySelectorAll(itemSelector);
        items.forEach((item, index) => {
            item.setAttribute("index", index);
        });
    });
}
export function moveCard(Card_ID, newIndex, list_ID){
    const list = document.querySelector('.list-item[id="'+list_ID+'"]');
    const card = list.parentElement.querySelector('.card-item[id="'+ Card_ID +'"]');
    let beforeItem;
    if(card.getAttribute("index") < newIndex && card.parentElement.parentElement.id == list_ID)  
        beforeItem = list.querySelector('.card-item[index="'+ (newIndex+1) +'"]');
    else beforeItem = list.querySelector('.card-item[index="'+ (newIndex) +'"]');
    if(!beforeItem) {
        beforeItem = list.querySelector('.card-item[index="'+ (newIndex) +'"]');
        if(!beforeItem){
            beforeItem = list.querySelector('.card-item[index="'+ (newIndex - 1) +'"]');
        }
        beforeItem.parentElement.insertBefore(card, beforeItem.nextElementSibling);
    }
    else {
        beforeItem.parentElement.insertBefore(card, beforeItem);
    } 
    reOrderIndex(".card-item", ".cards");
}
export function moveList(list_ID, newIndex){
    const list = document.querySelector('.list-item[id="'+list_ID+'"]');
    let beforeItem;
    console.log(newIndex)
    if(list.getAttribute("index") < newIndex)  
        beforeItem = list.parentElement.querySelector('.list-item[index="'+ (newIndex+1) +'"]');
    else beforeItem = list.parentElement.querySelector('.list-item[index="'+ newIndex +'"]');
    if(!beforeItem){
        beforeItem = list.parentElement.querySelector('.list-item[index="'+ newIndex +'"]');
        beforeItem.parentElement.insertBefore(list, beforeItem.nextElementSibling);
    } else beforeItem.parentElement.insertBefore(list, beforeItem);
    reOrderIndex(".list-item", ".project-container");
}
export function newListElement(id, title){
    const list = document.createElement("div");
    list.className = "list-item";
    list.draggable = true;
    list.id = id;
    list.innerHTML = `
    <div class="block-select">
        <div class="block-wall"></div>
        <textarea class="list-title" name="" id="" cols="30" rows="10" spellcheck="false">${title}</textarea>
    </div>
    <div class="cards">
        <button class="addcardbtn">Add +</button>
    </div>`;
    const btnDelete = document.createElement("button");
    btnDelete.className = "deletelist-btn";
    btnDelete.innerHTML = "Delete this list";
    btnDelete.onclick = removeListItem;
    list.appendChild(btnDelete);
    const container = document.querySelector('.project-container');
    container.insertBefore(list, container.lastElementChild);
    reOrderIndex(".list-item", ".project-container");
    applyEditableTitleToList(".list-item", ".list-title", ".block-wall");
    list.ondragstart = (e) => {
        // Adding dragging class to item after a delay
        e.stopPropagation();
        setTimeout(() => {
            list.classList.add("dragging");
        }, 0);
    };
    // Removing dragging class from item on dragend event
    list.ondragend = (e) => {
        e.stopPropagation();
        list.classList.remove("dragging");
        // gọi API đổi chỗ vị trí list
        reOrderIndex(".list-item", ".project-container");
        modifyListPosition(list.id, list.getAttribute('index'));
    };
}
async function deleteListFetch(id){
    const response = await fetch("http://127.0.0.1:8000/api/lists/"+id,{
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
export function modifyListTitle(id, newTitle){
    const list = document.querySelector('.list-item[id="'+id+'"]');
    const title = list.querySelector(".list-title");
    const blockWall = list.querySelector('.block-wall');
    const span = document.getElementById("heightExpanded");
    title.value = newTitle;
    span.textContent = title.value;
    title.style.height = span.offsetHeight + 'px';
    blockWall.style.height = span.offsetHeight + 'px';
}

async function modifyListPosition(id, index){
    const response = await fetch("http://127.0.0.1:8000/api/lists/index/"+id,{
        method: "PUT", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            index: index,
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
}
async function modifyCardPosition(id, index, list_ID){
    const response = await fetch("http://127.0.0.1:8000/api/cards/index/"+id,{
        method: "PUT", // or 'PUT'
        credentials: "same-origin",
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            list_ID: list_ID,
            index: index,
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
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
        span.style.setProperty('font-family', 'monospace');
        span.style.setProperty('width', document.querySelector(titleQuery).offsetWidth + "px");
        span.style.setProperty('visibility', "hidden");
        span.style.setProperty('position', "fixed");
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
                else modifyListTitle(list.id, title.value);
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
export function addCardButton(){
    const addBtns = Array.from(document.getElementsByClassName('addcardbtn'));
    const div = document.createElement('div');
    div.id = "addcardform";
    div.innerHTML = `<textarea class="list-title" name="title" id="title" placeholder="title"></textarea>
    <div class="button" style="display: block">
        <svg class="close" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"></path></svg>
        <svg class="check" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path></svg>
    </div>`;
    let span = document.getElementById("cardexpandheight");
    if(!span){
        span = document.createElement('span');
        span.id = "cardexpandheight";
        span.style = `display: block;
        text-wrap: wrap;
        word-break: break-all;
        background: #B6BBC4;
        border-radius: 10px;
        margin-bottom: 10px;
        padding: 12px 16px 12px 16px;
        font-size: 1.2rem;
        font-weight: bold;
        font-family: "Inter", sans-serif;
        cursor: pointer;
        width: 175px;
        visibility: hidden;
        position: fixed;
        white-space: pre-wrap;`;
        document.body.appendChild(span);
    }
    addBtns.forEach(function(addBtn){
        addBtn.onclick = (e) => {
            addBtn.parentElement.replaceChild(div, addBtn);
            setTimeout(function() {
                div.querySelector(".close").onclick = (e) => {
                    div.parentElement.replaceChild(addBtn, div);
                    textarea.value = "";
                };
                const textarea = div.querySelector('textarea');
                textarea.focus();
                textarea.oninput = (e) => {
                    span.textContent = textarea.value;
                    // blockwall.style.height = title.style.height;
                    if(textarea.value.trim() !== "") textarea.style.height = span.offsetHeight - 24 + 'px';
                };
                div.querySelector(".check").onclick = (e) => {
                    if(textarea.value.trim() !== "") {
                        // goi API CardCreated
                        addCardFetch(textarea.value.trim(), div.parentElement.parentElement.getAttribute("id"));
                        div.parentElement.replaceChild(addBtn, div);
                    }
                    // set value ""
                    textarea.value = "";
                };
            }, 0);
        };
    });
}
addCardButton();
export function removeListItemElement(id){
    const listItem = document.querySelector(`.list-item[id="${id}"]`);
    listItem.parentElement.removeChild(listItem);
    reOrderIndex(".list-item", ".project-container");
}
async function addCardFetch(title, list_ID){
    const response = await fetch("http://127.0.0.1:8000/api/cards",{
        method: "POST", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            title: title,
            list_ID: list_ID,
            workspace_ID: window.workspace_ID,
        })
    });
    const result = await response.json();
    console.log(result);
}
