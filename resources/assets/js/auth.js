function getMode() {
    return $('#auth-mode').attr('data-mode');
}

function getMail() {
    return $('input[name^="mail"]').val();
}

function getPass() {
    return $('input[name^="password"]').val();
}

function getPassRepeat() {
    return $('input[name^="password_repeat"]').val();
}

function checkPasswordsSame() {
    return getPass() === getPassRepeat();
}

function checkMail() {
    return (getMail().length > 0 && getMail().indexOf('@') !== -1 && getMail().indexOf('.') !== -1);
}

function checkLogin() {
    if(getMail().length > 0 && getPass().length >= 6 && checkMail()) {
        setAuthActive(true);
    } else {
        setAuthActive(false);
    }
}

function checkRegister() {
    if(getMail().length > 0 && getPass().length >= 6 && checkMail() && checkPasswordsSame()) {
        setAuthActive(true);
    } else {
        setAuthActive(false);
    }
}

function setAuthActive(state) {
    if(!state)
        $('#submit-auth').attr('disabled', 'disabled');
    else
        $('#submit-auth').removeAttr('disabled');
}

$('.input').keyup(function () {
    if(getMode() === 'login') {
        checkLogin();
    } else {
        checkRegister();
    }
});

setAuthActive(false);

