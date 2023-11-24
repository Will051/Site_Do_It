document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.querySelector('#formEsqueci');
    const campo = document.querySelector('#emailEsqueci');
    const span = document.querySelector('.spanEsqueci');
    const btn = document.querySelector('#esqueci');
    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        if(validaEmail())
        {
            form.submit();
        }
     
});


function validaEmail()
{
  if(emailRegex.test(campo.value))
  {
    return removeErro(campo, span);
  }
  else
  {
    return setErro(campo, span);
  }
}
function setErro(campo, span)
{
  campo.style.border = "2.5px solid red";
  span.style.display = "block";
  return false;
}

function removeErro(campo, span)
{
    campo.style.border = "";
    span.style.display = "none";
    return true;
}
});