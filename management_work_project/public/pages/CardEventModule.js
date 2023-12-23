export function newCardElement(title, index, list_ID){
    const card = document.createElement("div");
    card.className = "card-item";
    card.draggable = "true";
    card.setAttribute('index', index);
    card.innerHTML = " "+title+ " ";
    card.addEventListener("dragstart", (e) => {
        // Adding dragging class to item after a delay
        e.stopPropagation();
        setTimeout(() => {
            card.classList.add("dragging");
        }, 0);
    });
    // Removing dragging class from item on dragend event
    card.addEventListener("dragend", () => {
        card.classList.remove("dragging");
        reOrderIndex(".card-item", ".cards");
    });
    const list = document.querySelector('.list-item[id="'+list_ID+'"]');
    const beforeItem = list.querySelector('.card-item[index="'+ index +'"]');
    if(!beforeItem) list.querySelector('.cards').appendChild(card);
    else {
        beforeItem.parentElement.insertBefore(card, beforeItem);
    }
    reOrderIndex(".card-item", ".cards");
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
    card.setAttribute('index', newIndex);
    if(!beforeItem) list.querySelector('.cards').appendChild(card);
    else {
        beforeItem.parentElement.insertBefore(card, beforeItem);
    } 
    reOrderIndex(".card-item", ".cards");
}
export function moveList(list_ID, newIndex){
    const list = document.querySelector('.list-item[id="'+list_ID+'"]');
    let beforeItem;
    if(list.getAttribute("index") < newIndex)  
        beforeItem = list.parentElement.querySelector('.list-item[index="'+ (newIndex+1) +'"]');
    else beforeItem = list.parentElement.querySelector('.list-item[index="'+ newIndex +'"]');
    list.setAttribute('index', newIndex);
    if(!beforeItem){
        list.parentElement.appendChild(list);
    } else beforeItem.parentElement.insertBefore(list, beforeItem);
    
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
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            index: index,
        })
    });
    const result = await response.json();
    console.log(result);
}
async function modifyCardPosition(id, index, list_ID){
    const response = await fetch("http://127.0.0.1:8000/api/cards/index/"+id,{
        method: "PUT", // or 'PUT'
        headers: {
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            list_ID: list_ID,
            index: index,
        })
    });
    const result = await response.json();
    console.log(result);
}