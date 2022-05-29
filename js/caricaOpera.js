

const url = 'http://localhost/hw1/php/caricamentoDatiUtente.php';
fetch(url).then(datiResponse).then(datiJson); 

function datiResponse(response)
{
    return response.json(); 
}

const picture_profile = document.querySelector('img'); 

function datiJson(json)
{
    picture_profile.src="data:image/jpeg;base64,"+json[0].immagineProfilo;
}



//MENU MOBILE 


const menu = document.getElementById('menu'); 

menu.addEventListener('click', mostraMenu);

function mostraMenu(event)
{
    const modale_menu = document.querySelector('#modal-view-menu');
    modale_menu.classList.remove('hidden'); 
    
    const div_link = document.createElement('div'); 
    div_link.classList.add('div_link');
    

    const curiosità = document.createElement('a'); 
    curiosità.textContent='Curiosità'; 
    curiosità.href='http://localhost/hw1/php/mhw3.php'; 
    curiosità.classList.add('link_menu');

    const home = document.createElement('a'); 
    home.textContent='home'; 
    home.href='http://localhost/hw1/php/homePageLogin.php'; 
    home.classList.add('link_menu');

    const logout = document.createElement('a'); 
    logout.textContent='Logout'; 
    logout.href='http://localhost/hw1/php/logout.php'; 
    logout.classList.add('link_menu');

   
    const close = document.createElement('img'); 
    close.src="../images/close.png";
    close.classList.add('close_modale');

    modale_menu.appendChild(close); 
    modale_menu.appendChild(div_link); 
    div_link.appendChild(curiosità);
    div_link.appendChild(home);
    div_link.appendChild(logout);

    close.addEventListener('click', closeModaleMenu); 
}


function closeModaleMenu(event)
{
    const modale_menu = document.querySelector('#modal-view-menu');
    modale_menu.innerHTML='';
    modale_menu.classList.add('hidden');
}
