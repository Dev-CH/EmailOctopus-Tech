// Missing:
// NPM
// Client side validation
// Graceful error handling
// SCSS

document.addEventListener('DOMContentLoaded', () => {
    const table = document.getElementById('contact-list');
    const form = document.getElementById('add-contact');

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const email = document.getElementById("email").value;
        const name = document.getElementById("name").value;

        if (!email || !name) {
            return;
        }

        fetch('http://localhost:9000/api/contact', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({email, name})
        })
        .then(response => {
            if (response.status > 201) {
                throw new Error('Unexpected exception.');
            }

            return response.json()
        })
        .then(response => {
            const node = document.createElement('tr');
            node.dataset['id'] = response.id;
            node.innerHTML = '' +
                `<td>${response.name}</td>` +
                `<td>${response.email}</td>`+
                `<td>` +
                    `<button type="button" class="btn btn-sm btn-danger delete-contact">Delete</button>` +
                `</td>`;

            table.getElementsByTagName('tbody').item(0).prepend(node);
            document.getElementById('addContact-close').click();
        }).catch((e) => {
            console.error(e);
        });
    });

    table.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-contact')) {
            const row = event.target.closest('tr');
            const id = row.dataset.id;

            fetch(`http://localhost:9000/api/contact/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(response => {
              row.remove();
            });
        }
    });
});