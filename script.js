let applyBtns = document.querySelectorAll('.btnApply')
let closeModal = document.querySelector('.close_modal')
let modal = document.querySelector('.modal')
let inputforID = document.querySelector('input[name=apmID]')

applyBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
        modal.classList.add('modalActive')
        let btnID = btn.getAttribute('value')
        inputforID.value = btnID
    })
})

closeModal.onclick = function(){
    modal.classList.remove('modalActive')
}