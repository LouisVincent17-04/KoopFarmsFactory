document.addEventListener("DOMContentLoaded", (event) =>{
    const button = document.getElementById("changeVisibility");
    const text2Div = document.getElementById('text2Div');

    button.addEventListener('click', () => {
        text2Div.classList.toggle('open');
    });
});
