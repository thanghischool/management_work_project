
async function modifyCardPosition(id, index, list_ID){
    const response = await fetch("http://127.0.0.1:8000/api/cards/index/"+id,{
        method: "PUT", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
            'Accept':'application/json',
            'Content-Type':'application/json',
        },
        body: JSON.stringify({
            list_ID: list_ID,
            index: index,
        })
    });
    const result = await response.json();
}
async function modifyListPosition(id, index){
    const response = await fetch("http://127.0.0.1:8000/api/lists/index/"+id,{
        method: "PUT", // or 'PUT'
        headers: {
            'X-Socket-ID': window.Echo.socketId(),
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
function applyDragableIntoList(container, item){
    const sortableLists = document.querySelectorAll(container);
    for(const sortableList of sortableLists){
        const items = sortableList.querySelectorAll(item);
        items.forEach((item) => {
            item.addEventListener("dragstart", (e) => {
                // Adding dragging class to item after a delay
                e.stopPropagation();
                setTimeout(() => {
                    item.classList.add("dragging");
                }, 0);
            });
            // Removing dragging class from item on dragend event
            item.addEventListener("dragend", (e) => {
                e.stopPropagation();
                item.classList.remove("dragging");
                // gọi API đổi chỗ vị trí list
                reOrderIndex(".list-item", ".project-container");
                modifyListPosition(item.id, item.getAttribute('index'));
            });
        });
        
        const initSortableList = (e) => {
            e.preventDefault();
            e.stopPropagation();
            const draggingItem = document.querySelector(item+".dragging");
            // Getting all items except currently dragging and making array of them
            let siblings = [...sortableList.querySelectorAll(item)];
            // Finding the sibling after which the dragging item should be placed
            let aroundItems;
            for(let key in siblings){
                if(siblings[key] === draggingItem) {
                    aroundItems = [siblings[parseInt(key)-1],siblings[parseInt(key)+1]];
                    break;
                }
            }
            if(aroundItems[0] && aroundItems[1]){
                if (e.clientX + sortableList.scrollLeft + window.scrollX <= aroundItems[0].offsetLeft + aroundItems[0].offsetWidth / 2) {
                    sortableList.insertBefore(draggingItem, aroundItems[0]);
                } else if(e.clientX + sortableList.scrollLeft + window.scrollX >= aroundItems[1].offsetLeft + aroundItems[1].offsetWidth / 2){
                    sortableList.insertBefore(draggingItem, aroundItems[1].nextSibling);
                }
            } else if (aroundItems[0]){
                if (e.clientX + sortableList.scrollLeft + window.scrollX <= aroundItems[0].offsetLeft + aroundItems[0].offsetWidth / 2) {
                    sortableList.insertBefore(draggingItem, aroundItems[0]);
                }
            } else if (aroundItems[1]){
                if(e.clientX + sortableList.scrollLeft + window.scrollX >= aroundItems[1].offsetLeft + aroundItems[1].offsetWidth / 2){
                    sortableList.insertBefore(draggingItem, aroundItems[1].nextSibling);
                }
            }
        }
        
        sortableList.addEventListener("dragover", initSortableList);
        sortableList.addEventListener("dragenter", e => e.preventDefault());   
    }
}

function applyDragableIntoCard(container, item){
    const sortableLists = document.querySelectorAll(container);
    for(const key_list in sortableLists){
        if(typeof sortableLists[key_list] == "function"){
            break;
        }
        const items = sortableLists[key_list].querySelectorAll(item);
        const container1 = sortableLists[key_list]?.parentElement?.parentElement;
        items?.forEach((item,key) => {
            item.addEventListener("dragstart", (e) => {
                // Adding dragging class to item after a delay
                e.stopPropagation();
                setTimeout(() => {
                    item.classList.add("dragging");
                }, 0);
            });
            // Removing dragging class from item on dragend event
            item.addEventListener("dragend", (e) => {
                e.stopPropagation();
                item.classList.remove("dragging");
                reOrderIndex(".card-item", ".cards");
                let list_ID = item.parentElement.parentElement.getAttribute("id");
                let index = item.getAttribute("index");
                let card_ID = item.getAttribute("id");
                modifyCardPosition(card_ID, index, list_ID);
            });
        });
        
        const initSortableList = (e) => {
            e.preventDefault();
            e.stopPropagation();
            const draggingItem = document.querySelector(item+".dragging");
            // Getting all items except currently dragging and making array of them
            let siblings = [...sortableLists[key_list].querySelectorAll(item)];
            // Finding the sibling after which the dragging item should be placed
            let aroundItems;
            if (e.clientX + container1.scrollLeft + window.scrollX  > sortableLists[key_list].offsetLeft && sortableLists[key_list] !== draggingItem.parentElement) sortableLists[key_list].appendChild(draggingItem);
            for(let key in siblings){
                if(siblings[key] === draggingItem) {
                        aroundItems = [siblings[parseInt(key)-1],siblings[parseInt(key)+1]];
                        break;
                }
            }
            if(aroundItems[0] && aroundItems[1]){
                if (e.clientY + container1.scrollTop + window.scrollY  <= aroundItems[0].offsetTop + aroundItems[0].offsetHeight / 2) {
                    sortableLists[key_list].insertBefore(draggingItem, aroundItems[0]);
                } else if(e.clientY + container1.scrollTop + window.scrollY  >= aroundItems[1].offsetTop + aroundItems[1].offsetHeight / 2){
                    sortableLists[key_list].insertBefore(draggingItem, aroundItems[1].nextSibling);
                }
            } else if (aroundItems[0]){
                if (e.clientY + container1.scrollTop + window.scrollY  <= aroundItems[0].offsetTop + aroundItems[0].offsetHeight / 2) {
                    sortableLists[key_list].insertBefore(draggingItem, aroundItems[0]);
                }
            } else if (aroundItems[1]){
                if(e.clientY + container1.scrollTop + window.scrollY  >= aroundItems[1].offsetTop + aroundItems[1].offsetHeight / 2){
                    sortableLists[key_list].insertBefore(draggingItem, aroundItems[1].nextSibling);
                }
            }
        }
        
        sortableLists[key_list].addEventListener("dragover", initSortableList);
        sortableLists[key_list].addEventListener("dragenter", e => e.preventDefault());   
    }
}


function reOrderIndex(itemSelector, containerSelector){
    const containers = document.querySelectorAll(containerSelector);
    containers.forEach((container) => {
        const items = container.querySelectorAll(itemSelector);
        items.forEach((item, index) => {
            item.setAttribute("index", index);
        });
    });
}