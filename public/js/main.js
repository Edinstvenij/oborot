// TODO Иногда не находит ID

if (document.getElementById('operationsModal')) {
    const operationsModal = document.getElementById('operationsModal');
    let lastId = false;
    operationsModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute('data-bs-whatever');
        const recipientId = button.getAttribute('data-id');
        console.log(recipientId);


        // Update the modal's content.
        const modalTitle = operationsModal.querySelector('.modal-title');
        const modalLinks = operationsModal.querySelectorAll('a');


        modalTitle.textContent = `Операции с ${recipient}`;

        if (!lastId) {
            modalLinks.forEach(function (link) {
                link.href = link.href.replace('replacement', recipientId)
            });

            lastId = recipientId;
        } else {
            modalLinks.forEach(function (link) {
                link.href = link.href.replace(lastId, recipientId)
            });

            lastId = recipientId;
        }
    })
}


const input = document.querySelector('#input');
const result = document.querySelector('#result');
const select = document.querySelector('#select');

console.log(input, result, select);
