var openModal = document.querySelector('.open-modal-btn')
var Modal = document.querySelector('.modal')
var closeModal = document.querySelector('.modal__header .fa-xmark')

function toggleModal(e){
    Modal.classList.toggle('hide')
}

openModal.addEventListener('click', toggleModal)
Modal.addEventListener('click', function(e){
  if(e.target == e.currentTarget){
    toggleModal();
  }
})
closeModal.addEventListener('click', toggleModal)


const element = document.querySelector(".asd");

element.addEventListener("click", (event) => {
  alert(element.textContent);
});




var opentodolist_popup = document.querySelector('.open-todolist-btn')
var todolist_popup = document.querySelector('.todolist-popup')
var closetodolist_popup = document.querySelector('.closetodolist-popup')
function toggletodolist_popup(e){
    todolist_popup.classList.toggle('hide')
}

opentodolist_popup.addEventListener('click', toggletodolist_popup);
todolist_popup.addEventListener('click', function(e){
  if(e.target == e.currentTarget){
    toggletodolist_popup();
  }
})
closetodolist_popup.addEventListener('click', toggletodolist_popup)






var opentodolist = document.querySelector('.addtodolist-btn')
var todolist = document.querySelector('.todolist')
var closetodolist = document.querySelector('.slide-header .closetodolist')

function toggletodolist(e){
    todolist.classList.toggle('hide')
    toggletodolist_popup(); 
}

opentodolist.addEventListener('click', toggletodolist)
todolist.addEventListener('click', function(e){
  if(e.target == e.currentTarget){
    toggletodolist();
  }
})
closetodolist.addEventListener('click', toggletodolist)






var openaddfile_popup = document.querySelector('.open-addfile-btn')
var addfile_popup = document.querySelector('.addfile-popup')
var closeaddfile_popup = document.querySelector('.closeaddfile-popup')
function toggleaddfile_popup(e){
    addfile_popup.classList.toggle('hide')
    
}

openaddfile_popup.addEventListener('click', toggleaddfile_popup);
addfile_popup.addEventListener('click', function(e){
  if(e.target == e.currentTarget){
    toggleaddfile_popup();
  }
})
closeaddfile_popup.addEventListener('click', toggleaddfile_popup)






var openaddfile = document.querySelector('.addfile-btn')
var addfile = document.querySelector('.addfile')
var closeaddfile = document.querySelector('.slide-header .closeaddfile')

function toggleaddfile(e){
    addfile.classList.toggle('hide')
    toggleaddfile_popup(); 
}

openaddfile.addEventListener('click', toggleaddfile)
addfile.addEventListener('click', function(e){
  if(e.target == e.currentTarget){
    toggleaddfile();
  }
})
closeaddfile.addEventListener('click', toggleaddfile)





// function addItemToChecklist(content){
//   const container = document.querySelector(".todolist .slide-body");
//   const check = document.createElement("div");
//   check.className = "check";
//   check.innerHTML = `<input type="checkbox">
//   <p class="check-content">${content}</p>`;
//   container.insertBefore(check, container.lastElementChild);
//   // const lastElementChild = container.lastElementChild;
//   // const firstElementChild = container.firstElementChild;
//   // console.dir(container);
//   // console.log(container.parentElement);
// }
function addItemToChecklist(content) {
  const container = document.querySelector(".todolist .slide-body");
  const check = document.createElement("div");
  check.className = "check";
  check.innerHTML = `<input type="checkbox">
  <p class="check-content">${content}</p>`;
  container.insertBefore(check, container.querySelector(".addcheck-btn"));
}

const addCheckForm = document.querySelector(".addcheck");
const addCheckButton = addCheckForm.querySelector(".addcheck-btn-ss");
const addCheckInput = addCheckForm.querySelector(".addcheck-content");

addCheckButton.addEventListener("click", (event) => {
  event.preventDefault(); // Prevent default form submission

  const content = addCheckInput.value.trim();
  if (content) {
    addItemToChecklist(content);
    addCheckInput.value = ""; // Clear input field
  }
});

var openaddcheck = document.querySelector('.addcheck-btn');
var addcheck = document.querySelector('.addcheck');
var closeaddcheck = document.querySelector('.closeaddcheck');

function toggleaddcheck(e) {
  addcheck.classList.toggle('hide');
  openaddcheck.classList.toggle('hide'); // Toggle "Add" button visibility
}

openaddcheck.addEventListener('click', toggleaddcheck);
addcheck.addEventListener('click', function(e) {
  if (e.target == e.currentTarget) {
    toggleaddcheck();
  }
});
closeaddcheck.addEventListener('click', toggleaddcheck);


async function getImageUrl(link) {
  const response = await fetch(link);
  const image = await response.text();
  const img = cheerio.load(image).find("img").first();
  const imageUrl = img.attr("src");
  return imageUrl;
}


function addItemToAddfile(link) {
  const container = document.querySelector(".addfile .slide-body");
  const file = document.createElement("div");
  const url = new URL(link);
  
  file.className = "cardfile";
  file.innerHTML = `<img src="${getImageUrl(link)}" alt="" class="fileimg">
  <div class="contentfile">
      <div class="namefile">
          <h4 class="namefile">${url.hostname}</h4>
      </div>
      <div class="descfile">
          <p>30/12/2023</p>
      </div>
      <div class="btnfile">
          <button class="btnn">Edit</button>
      </div>`;
  container.insertBefore(file, container.querySelector(".addfilenew-btn"));
}

const addFileForm = document.querySelector(".addfilenew");
const addFileButton = addFileForm.querySelector(".addfile-btn-ss");
const addFileInput = addFileForm.querySelector(".addfile-content");

addFileButton.addEventListener("click", (event) => {
  event.preventDefault(); // Prevent default form submission

  const link = addFileInput.value.trim();
  if (link) {
    addItemToAddfile(link);
    addFileInput.value = ""; // Clear input field
  }
});

var openaddfilenew = document.querySelector('.addfilenew-btn');
var addfilenew = document.querySelector('.addfilenew');
var closeaddfilenew = document.querySelector('.closeaddfilenew');

function toggleaddfilenew(e) {
  addfilenew.classList.toggle('hide');
  openaddfilenew.classList.toggle('hide'); // Toggle "Add" button visibility
}

openaddfilenew.addEventListener('click', toggleaddfilenew);
addfilenew.addEventListener('click', function(e) {
  if (e.target == e.currentTarget) {
    toggleaddfilenew();
  }
});
closeaddfilenew.addEventListener('click', toggleaddfilenew);
