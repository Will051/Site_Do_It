document.addEventListener('DOMContentLoaded', (event) => {
  const form = document.querySelector('#form_cadastro');
  const campos = document.querySelectorAll('.required');
  const spans = document.querySelectorAll('.span_invalido');
  const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  const digitRegex = /^\d+$/;

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    if(validaNome() &&
    validaEmail() &&
    validaTel() &&
    validaCPF() &&
    validaSenha() &&
    confirmaSenha())
    {
      form.submit();
    }


  });

function validaNome()
{
  if (campos[0].value.length < 3)
  {
    return setErro(0);
  }
  else
  {
    return removeErro(0)
  }
}

function confirmaSenha()
{
  if(campos[3].value != campos[5].value)
  {
    return setErro(5);
  }
  else
  {
    return removeErro(5);
  }
}

function validaSenha()
{
  if(campos[3].value.length < 8)
  {
    return setErro(3);
  }
  else
  {
    return removeErro(3);
  }
}

function validaEmail()
{
  if(emailRegex.test(campos[2].value))
  {
    return removeErro(2);
  }
  else
  {
    return setErro(2);
  }
}

function validaTel()
{
  if(campos[4].value.length < 11 || campos[4].value.length > 14 || !digitRegex.test(campos[4].value))
  {
    return setErro(4);
  }
  else
  {
    return removeErro(4);
  }
}
function validaCPF()
{
  if (campos[1].value.length < 11 || !digitRegex.test(campos[1].value))
  {
    return setErro(1);
  }
  else
  {
    return removeErro(1);
  }
}

function setErro(index)
{
  campos[index].style.border = "2.5px solid red";
  spans[index].style.display = "block";
  return false;
}

function removeErro(index)
{
    campos[index].style.border = "";
    spans[index].style.display = "none";
    return true;
}
});


