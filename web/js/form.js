let form = document.getElementById('form');

document.getElementById('test-btn')
    .addEventListener('click', () => {

        for (let child of form.children[0].children) {
            child.classList.add('form-none');
        }

        let animate = document.getElementById('animate');
        animate.classList.add('form-animated');
        let newEl = document.createElement('div');
        newEl.className = "loader";
        let { body } = event;
        setTimeout(() => {
            animate.classList = "";
            animate.append(newEl);
        }, 510);
    });