document.addEventListener('DOMContentLoaded', () => {
    const modalCourse = document.querySelector('.modalCourse');
    const closeModalButton = document.querySelector('.close_modalCourse');
    const modalNosaukums = document.getElementById('modalNosaukums');
    const modalApraksts = document.getElementById('modalApraksts');
    const modalAttels = document.getElementById('modalAttels');
    const modalKurssID = document.getElementById('modalKurssID');
    const checkButtons = document.querySelectorAll('.checkButton');

    checkButtons.forEach(button => {
        button.addEventListener('click', () => {
            const kurssID = button.getAttribute('data-kurss-id');
            const kurssNosaukums = button.getAttribute('data-kurss-nosaukums');
            const kurssApraksts = button.getAttribute('data-kurss-apraksts');
            const kurssAttels = button.getAttribute('data-kurss-attels');

            modalNosaukums.textContent = kurssNosaukums;
            modalApraksts.textContent = kurssApraksts;
            modalAttels.src = kurssAttels;
            modalKurssID.value = kurssID;

            modalCourse.classList.add('modalActive');
        });
    });

    closeModalButton.onclick = function(){
        modalCourse.classList.remove('modalActive');
    }
});