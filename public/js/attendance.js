function toggleFormElements(bDisabled) { 
    var inputs = document.getElementsByTagName("input"); 
    for (var i = 0; i < inputs.length; i++) { 
        inputs[i].disabled = bDisabled;
    } 
    var selects = document.getElementsByTagName("select");
    for (var i = 0; i < selects.length; i++) {
        selects[i].disabled = bDisabled;
    }
    var textareas = document.getElementsByTagName("textarea"); 
    for (var i = 0; i < textareas.length; i++) { 
        textareas[i].disabled = bDisabled;
    }
    var buttons = document.getElementsByTagName("button");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = bDisabled;
    }
}


document.getElementById('check-in-loc-btn').onclick = function(){
    var timezone = document.getElementById('check-out-timezone').disabled;
    var description = document.getElementById('check-out-description').disabled;
    var submit = document.getElementById('check-out-submit').disabled;
    if(timezone && description && submit) {
        timezone.disabled = false;
        description.disabled = false;
        submit.disabled = false;
    }else{
        timezone.disabled = true;
        description.disabled = true;
        submit.disabled = true;
    }
}

// function toggleCheckOutLoc(){
//     var timezone = document.getElementById('check-out-timezone').disabled = false;
//     var description = document.getElementById('check-out-description').disabled = false;
//     var submit = document.getElementById('check-out-submit').disabled = false;
// }

