

$(document).ready(function(){
      $("#formlogin").validate({
         rules: { 
          cpf_login: { required: true, minlength: 10, maxlength: 10 },
          senha_login: { required: true, minlength: 2, maxlength: 20 }
         },
         messages: {
            cpf_login: { required: " CPF - obrigatorio",
                   minlength: " O CPF deve possuir no mínimo 10 números",
                   maxlength: " Limite de caracteres ultrapassado." },
         senha_login: { required: " Senha - obrigatorio",
                    minlength: " A senha deve possuir no mínimo 2 caracteres.",
                    maxlength: " Limite de caracteres ultrapassado." }
         }
      });

    }); 