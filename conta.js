function register(event){

    event.preventDefault();
    var nome = document.getElementById('firstName').value;
    var apelido = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var password2 = document.getElementById('repeatPassword').value;
    var isValid = validatePassword(password);

    if(!nome || !apelido || !email || !password || !password2){
        alert("Todos os campos são de preenchimento obrigatório.");
    } else {
        if(isValid){
            if(password == password2){
                $.ajax({
                    type: 'POST',
                    data: {
                        nome: nome,
                        apelido: apelido,
                        email: email,
                        password: password,
                        op: 1
                    },
                    url: "contaModel.php",
                    success: function(result){

                        if(result == "Este email já tem uma conta associada."){
                            alert(result);
                        } else {
                            console.log(result);
                            document.getElementById('registration_form').reset();
                            document.getElementById('pwValidation').style.display = "none";
                            //sendConfirmationEmail(nome, apelido, email);
                            $("#success_tic").modal('show');
                        }
                        
                    }
                })
            } else {
                document.getElementById('pwValidation').style.display = "block";
            }
        }
    }
    
}

function validatePassword(password) {
    const regras = [
        { regex: /[a-z]/, message: 'Uma letra minúscula' },
        { regex: /[A-Z]/, message: 'Uma letra maiúscula' },
        { regex: /\d/, message: 'Um número' },
        { regex: /[@$!%^*?&:]/, message: 'Um caractere especial (@$!%^*?&:)' },
        { regex: /^.{8,}$/, message: 'Pelo menos 8 caracteres' }
    ];
    
    const regrasFalhadas = regras
        .filter(regra => !regra.regex.test(password))
        .map(regra => regra.message);
    
    if (regrasFalhadas.length > 0) {
        alert('A palavra-passe deve conter:\n- ' + regrasFalhadas.join('\n- '));
        return false;
    }

    return true;
}

function sendConfirmationEmail(nome, apelido, email){

    $.ajax({
        type: 'POST',
        data: {
            nome: nome,
            apelido: apelido,
            email: email,
            op: 2
        },
        url: "contaModel.php",
        success: function(result){
            console.log(result);
        }
    })
}

function goToLogin(){

    
    window.location.href = "login.php";

}

function login(event){

    event.preventDefault();
    var email = document.getElementById('emailLogin').value;
    var password = document.getElementById('passwordLogin0').value;
    var rememberMe = document.getElementById('customCheck').checked;

    $.ajax({
        type: 'POST',
        data: {
            email: email,
            password: password,
            rememberMe: rememberMe,
            op: 3
        },
        url: "contaModel.php",
        success: function(result){
            console.log(result);
            var obJSON = JSON.parse(result);
            if(obJSON.result != "Passwords match"){
                alert(obJSON.result);
            } else {
                localStorage.setItem('authToken', obJSON.token);
                window.location.href = "index.html";
            }
        }
    })
}


