export default  function () {
    const editSubmitButton = document.getElementById('edit-form__button');
    const editTitle = document.getElementById('edit-title');
    const editArtist = document.getElementById('edit-artist');
    const editUserDescription = document.getElementById('edit-description');
    const editAutocompleteDescription = document.getElementById('edit-autocomplete-description');
    const editCoverUrl = document.getElementById('edit-cover_url');
    const editUseAutocompletionFlag = document.getElementById('edit-use_autocompletion');
    const editForm = document.getElementById('album-edit-form');
    const editToken = document.querySelector("input[name='_token']");
    const editError = document.querySelector("p.creation-form__error-message");

    if (!editSubmitButton) {
        return;
    }

    editSubmitButton.addEventListener('click', (e) => {
        e.preventDefault();
        let description = '';

        if (editUseAutocompletionFlag.checked) {
            description = editAutocompleteDescription.textContent;
        } else {
            description = editUserDescription.value;
        }

        const data = {
            title: editTitle.value,
            artist: editArtist.value,
            description: description,
            cover_url: editCoverUrl.value,
            use_autocompletion: editUseAutocompletionFlag.checked,
            '_token': editToken.value,
        }

        fetch(editForm.action, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: {
                'Content-type': 'application/json; charset=UTF-8',
            }
        })
            .then((response) => {
                if (response.status === 422) {
                    response = response.json();

                    response.then((data) => {

                        for (let property in data.errors) {
                            let validationError = document.getElementById(`${property}-error`);

                            validationError.textContent = data.errors[property];
                            validationError.classList.remove('display-none');
                        }
                    });
                }

                if (response.status === 400) {
                    response = response.json();

                    response.then((data) => {
                        if (data.errors) {
                            editError.textContent = data.errors.message;
                            editError.classList.remove('display-none');
                        }
                    });
                }

                if (response.ok) {
                    response = response.json();

                    response.then((data) => {
                        if (data.data?.message === "success") {
                            console.log(data.data);
                            window.location = data.data?.redirect_to;
                        }
                    });
                }
            })
    })
}
