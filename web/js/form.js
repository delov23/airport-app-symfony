let form = document.getElementById('form');

document.getElementById('test-btn')
    .addEventListener('click', () => {
        if (form.checkValidity()) {
            console.log('here');
            for (let child of form.children[0].children) {
                child.classList.add('form-none');
            }

            let animate = document.getElementById('animate');
            animate.classList.add('form-animated');
            let newEl = document.createElement('div');
            newEl.className = "loader";
            setTimeout(() => {
                animate.classList = '';
                animate.append(newEl);
            }, 510);
        }
    });

document.getElementById('input-img')
    .addEventListener('change', (ev) => {
        let fi = document.querySelector('label.file-input');
        fi.style.backgroundImage = `url('https://yak-ridge.com/wp-content/uploads/2019/04/image-placeholder-350x350.png')`;
        fi.style.backgroundSize = 'cover';
        fi.innerText = '';
        document.querySelector('p.file-description').style.display = 'none';
    });