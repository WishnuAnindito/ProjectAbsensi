var form_check_in_loc = document.forms['check-in-loc'], // form element to be "readonly"
    submit_btn_check_in_loc = document.querySelector('check-in-loc-btn')

submit_btn_check_in_loc.addEventListener('click', lockForm)

function lockForm(){
    submit_btn_check_in_loc.classList.toggle('on');
    [].slice.call( form.elements ).forEach(function(item){
        item.disabled = !item.disabled;
    });
}