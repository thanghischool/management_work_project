var openModal = document.querySelector(".open-modal-btn");
var Modal = document.querySelector(".modal");
var closeModal = document.querySelector(".modal__header .fa-xmark");

function toggleModal(e) {
    Modal.classList.toggle("hide");
}

openModal.addEventListener("click", toggleModal);
Modal.addEventListener("click", function (e) {
    if (e.target == e.currentTarget) {
        toggleModal();
    }
});
closeModal.addEventListener("click", toggleModal);

const element = document.querySelector("asd");

element.addEventListener("click", (event) => {
    alert(element.textContent);
});


