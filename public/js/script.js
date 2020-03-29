const events = document.getElementById('events');
if (events) {
    events.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-event') {
            if (confirm('vous voulez supprimer cette évenemnt ?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/delete/event/{id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }

        }
    })
}