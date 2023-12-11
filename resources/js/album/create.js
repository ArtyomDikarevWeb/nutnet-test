export default  function () {
    const submitButton = document.getElementById('creation-form__button');
    const title = document.getElementById('title');
    const artist = document.getElementById('artist');
    const userDescription = document.getElementById('description');
    const autocompleteDescription = document.getElementById('autocomplete-description');
    const coverUrl = document.getElementById('cover_url');
    const useAutocompletionFlag = document.getElementById('use_autocompletion');
    const form = document.getElementById('album-creation-form');
    const token = document.querySelector("input[name='_token']");
    const error = document.querySelector("p.creation-form__error-message");

    if (!submitButton) {
        return;
    }

    submitButton.addEventListener('click', (e) => {
        e.preventDefault();
        let description = '';

        if (useAutocompletionFlag.checked) {
            description = autocompleteDescription.textContent;
        } else {
            description = userDescription.value;
        }

        const data = {
            title: title.value,
            artist: artist.value,
            description: description,
            cover_url: coverUrl.value,
            use_autocompletion: useAutocompletionFlag.checked,
            '_token': token.value,
        }

        fetch(form.action, {
            method: 'POST',
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
                        error.textContent = data.errors.message;
                        error.classList.remove('display-none');
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
