let table = document.getElementById('currencies');

let rows = table.getElementsByClassName('row-link');
// table.addEventListener('click', function (e) {
//     console.log(e.target.closest('tr'));
// })


const exampleModal = document.getElementById('operationsModal')
exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')


    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = `Операции с ${recipient}`
    modalBodyInput.value = recipient
})
