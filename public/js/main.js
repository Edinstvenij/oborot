document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('operationsModal')) {
        const operationsModal = document.getElementById('operationsModal');
        const currencies = document.querySelectorAll('tbody tr.row-link');
        currencies[0].focus();

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


        const linksNavY = document.getElementById('currencies').querySelectorAll('.nav-y');
        let indexY = 0;
        document.querySelector('#currencies').addEventListener('keydown', event => {
            const key = event.code;
            switch (key) {
                case 'ArrowDown':
                    indexY = indexY + 1 === linksNavY.length ? linksNavY.length - 1 : ++indexY;
                    linksNavY[indexY].focus();

                    event.preventDefault();
                    break;

                case 'ArrowUp':
                    indexY = indexY - 1 > 0 ? --indexY : 0;
                    linksNavY[indexY].focus();

                    event.preventDefault();
                    break;

                case 'Enter':
                    if (document.activeElement.matches('tr')) {
                        document.activeElement.click();
                        modal.addEventListener('keydown', handleKeyDown);
                        focusableElements[1].focus();
                    }
                    break;
            }
        });
        const modal = document.getElementById('operationsModal');
        const focusableElements = modal.querySelectorAll('a, button');

        let currentFocus = 0;

        function handleKeyDown(event) {
            focusableElements.forEach(item => {
                item.classList.remove('active');
            })

            const key = event.code;
            switch (key) {
                case 'ArrowDown':
                    currentFocus = (currentFocus + 1) % focusableElements.length;
                    focusableElements[currentFocus].focus();
                    break;
                case 'ArrowUp':
                    currentFocus = (currentFocus - 1 + focusableElements.length) % focusableElements.length;
                    focusableElements[currentFocus].focus();
                    break;
            }
        }

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
                modalBodyText.textContent = `${sum.value} X ${course.value} = ${(sum.value * course.value).toFixed(2)}`;
                btnSubmit.focus();
            }

            btnSubmit.addEventListener('click', () => {
                form.submit();
            });
        });
    }


    const headerLinks = document.querySelectorAll('.nav-x');
    let headerIndex = 0;

    document.addEventListener('keydown', event => {
        const key = event.code;

        headerLinks.forEach(link => {
            link.classList.remove('active');
        });

        switch (key) {
            case 'ArrowRight':
                headerIndex = (headerIndex + 1) % headerLinks.length;
                headerLinks[headerIndex].classList.add('active');
                headerLinks[headerIndex].focus();

                event.preventDefault();
                break;

            case 'ArrowLeft':
                headerIndex = (headerIndex - 1 + headerLinks.length) % headerLinks.length;
                headerLinks[headerIndex].classList.add('active');
                headerLinks[headerIndex].focus();

                event.preventDefault();
                break;
        }
    });

});
