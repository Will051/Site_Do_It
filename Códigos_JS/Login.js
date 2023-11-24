document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.querySelector('#form_login');
    const campos = document.querySelectorAll('.required');
    const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const digitRegex = /^\d+$/;
  
    form.addEventListener('submit', (event) => {
     
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

    function validaSenha()
    {
    if(campos[1].value.length < 8)
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
    return true;
}
});

