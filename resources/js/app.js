import './bootstrap';


document.addEventListener("DOMContentLoaded", function () {
    const color = document.querySelector('#colorPicker');
    const inputText = document.querySelector('#messageContent');
    const btn = document.querySelector('#btn');

    const colorBg = () => {
        document.body.style.backgroundColor = color.value;
    }

    color.addEventListener('input', colorBg);

    inputText.addEventListener('input', () => {
        if (inputText.value.trim() !== "") {
            btn.removeAttribute('disabled');
            btn.style.backgroundColor = '#00a5dd';
        } else {
            btn.setAttribute('disabled', 'disabled');
            btn.style.backgroundColor = '#eaf6fd';
            btn.hover.style.backgroundColor = "#97cdf3";
        }
    });

    // ボタンがマウスに乗った時の処理
    btn.addEventListener('mouseenter', () => {
        if (btn.disabled) {
            btn.style.backgroundColor = '#97cdf3';
        }
    });

    // ボタンからマウスが離れたときの処理
    btn.addEventListener('mouseleave', () => {
        if (btn.disabled) {
            btn.style.backgroundColor = '#eaf6fd';
        }
    });
});



