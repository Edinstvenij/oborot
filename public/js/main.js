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

if (document.getElementById('confirmation')) {
    const form = document.getElementById('form');
    const course = form.querySelector('#course');
    const sum = form.querySelector('#result');

    const confirmationModal = document.getElementById('confirmation')
    confirmationModal.addEventListener('show.bs.modal', event => {

        const btnSubmit = confirmationModal.querySelector('#submit');

        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        const modalTitle = confirmationModal.querySelector('.modal-title')
        const modalBodyText = confirmationModal.querySelector('.modal-body p')

        modalTitle.textContent = recipient;

        if (sum.value === '' || course.value === '') {
            modalBodyText.textContent = `Заполните все поля!`;
        } else {
            modalBodyText.textContent = `${sum.value} X ${course.value} = ${sum.value * course.value}`;
        }

        btnSubmit.addEventListener('click', () => {
            form.submit();
        });
    });
}
