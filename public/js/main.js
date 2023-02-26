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
            modalBodyText.textContent = `${sum.value} X ${course.value} = ${(sum.value * course.value).toFixed(2)}`;
        }

        btnSubmit.addEventListener('click', () => {
            form.submit();
        });
    });
}


const linksNavX = document.querySelectorAll('.nav-x');
const linksNavY = document.getElementById('currencies').querySelectorAll('.nav-y');
let indexX = 0;
let indexY = 0;

document.addEventListener('keydown', event => {
    const key = event.code;

    linksNavX.forEach(link => {
        link.classList.remove('active');
    });

    switch (key) {
        case 'ArrowRight':
            if (indexX < 0 || indexX >= linksNavX.length) {
                indexX = 0;
            }

            linksNavX[indexX].classList.add('active');
            linksNavX[indexX].focus();
            indexX++;
            break;

        case 'ArrowLeft':
            indexX--;

            if (indexX < 0 || indexX >= linksNavX.length) {
                indexX = linksNavX.length - 1;
            }

            linksNavX.forEach(link => {
                link.classList.remove('active');
            });

            linksNavX[indexX].classList.add('active');
            linksNavX[indexX].focus();
            break;

        case 'ArrowDown':
            if (indexY < 0 || indexY >= linksNavY.length) {
                indexY = 0;
            }

            linksNavY[indexY].focus();

            indexY++;
            break;

        case 'ArrowUp':
            indexY--;

            if (indexY < 0 || indexY >= linksNavY.length) {
                indexY = linksNavY.length - 1;

            }

            linksNavY[indexY].focus();
            break;

        case 'Enter':
            if (document.activeElement.matches('tr')) {
                document.activeElement.click();
                modal.addEventListener('keydown', handleKeyDown);

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
    if (event.key === 'ArrowDown') {
        currentFocus = (currentFocus + 1) % focusableElements.length;
        focusableElements[currentFocus].classList.add('active');
        event.preventDefault();
    } else if (event.key === 'ArrowUp') {
        currentFocus = (currentFocus - 1 + focusableElements.length) % focusableElements.length;
        focusableElements[currentFocus].classList.add('active');
        event.preventDefault();
    }
}
