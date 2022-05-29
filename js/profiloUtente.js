const url = 'http://localhost/hw1/php/caricamentoDatiUtente.php';

fetch(url).then(datiResponse).then(datiJson); 

function datiResponse(response)
{
    return response.json(); 
}

const picture_profile = document.querySelector('.picture-profile-content'); 
const picture_profile1=document.querySelector('.picture-profile');
function datiJson(json)
{
    
    console.log(json);
   //carico immagine profilo dell'utente loggato
   picture_profile.src="data:image/jpeg;base64,"+json[0].immagineProfilo;
   picture_profile1.src="data:image/jpeg;base64,"+json[0].immagineProfilo;
   document.querySelector('.username2').textContent="@"+json[0].username;
   
   document.getElementById('nome').textContent=json[0].nome;
   document.getElementById('cognome').textContent=json[0].cognome;
   document.getElementById('numeroOpereCaricate').textContent=json[0].numeroOpereCaricate;
   document.getElementById('email').textContent=json[0].email;
   document.getElementById('descrizione').textContent=json[0].descrizione;

}


const url_opere_utente = 'http://localhost/hw1/php/caricamentoOpereUtente.php';

const contenitore_opere= document.querySelector('.general-work-utente');
fetch(url_opere_utente).then(opereResponse).then(opereJson); 

function opereResponse(response)
{
    return response.json(); 
}

function opereJson(json)
{
    let num_results = json.length;
    console.log(json);

   if(num_results !== 0)
   {
        for(let i = 0; i<num_results ; i++)
        {   

            const contenitore_opera = document.createElement('div'); 
            contenitore_opera.classList.add('contenitore_opera_totale');

            const contenitore_informazioni_opera = document.createElement('div'); 
            contenitore_informazioni_opera.classList.add('contenitore_informazioni_opera');
            
            const titolo_opera = document.createElement('h1'); 
            titolo_opera.classList.add('titolo_opera'); 
            titolo_opera.textContent = json[i].nome; 

            const info_utente_opera = document.createElement('div'); 
            info_utente_opera.classList.add('info_utente_opera'); 

            const src_immagine_profilo = document.createElement('img'); 
            src_immagine_profilo.src = "data:image/jpeg;base64,"+json[i].immagineProfilo;
            src_immagine_profilo.classList.add('picture-profile_utente'); 

            const username_utente_opera = document.createElement('span'); 
            username_utente_opera.classList.add('titolo_opera');
            username_utente_opera.textContent=json[i].username; 

            const contenitore_immagine_opera = document.createElement('div'); 
            contenitore_immagine_opera.classList.add('contenitore_immagine'); 
        
            const immagine_opera = document.createElement('img');
            immagine_opera.src="data:image/jpeg;base64,"+json[i].immagineOpera;
            immagine_opera.id=json[i].idOpera;
            immagine_opera.classList.add('immagine');

            const heart = document.createElement('img');
            heart.src="../images/heart_white.png"; 
            heart.classList.add('like'); 
            heart.id = json[i].idOpera;

            const star = document.createElement('img');
            star.src="../images/star.png"; 
            star.classList.add('star'); 
            star.id = json[i].idOpera;

            const comment = document.createElement('img');
            comment.src="../images/sms.png"; 
            comment.classList.add('comment'); 
            comment.id = json[i].idOpera;
            
            const span = document.createElement('span');
            span.classList.add('info_utente_opera'); 

            const like = document.createElement('span'); 
            like.textContent=json[i].likes;
            like.id=json[i].idOpera;
            like.classList.add('number_like'); 

            const div_like = document.createElement('div'); 
            div_like.classList.add('div_like');

            const numero_commenti = document.createElement('span'); 
            numero_commenti.textContent=json[i].commenti; 
            numero_commenti.classList.add('number_like'); 

            contenitore_opere.appendChild(contenitore_opera); 
            contenitore_opera.appendChild(contenitore_immagine_opera); 
            contenitore_immagine_opera.appendChild(immagine_opera);

            contenitore_opera.appendChild(contenitore_informazioni_opera); 
            contenitore_informazioni_opera.appendChild(titolo_opera); 
            contenitore_informazioni_opera.appendChild(info_utente_opera); 

            info_utente_opera.appendChild(span);
            span.appendChild(src_immagine_profilo); 
            span.appendChild(username_utente_opera);
            info_utente_opera.appendChild(div_like);
            div_like.appendChild(star); 
            div_like.appendChild(heart); 
            div_like.appendChild(like);
            div_like.appendChild(comment);
            div_like.appendChild(numero_commenti);

            heart.addEventListener('click', prova);
            star.addEventListener('click', preferiti); 
            //comment.addEventListener('click', commenti);  
            
            //immagine_opera.addEventListener('click', anteprima); 
        }
        
    }

}



/* --------------------ADD LIKE OPERE  -------------------- */
 

function prova(event)
{

    console.log(event.currentTarget.src);

    if(event.currentTarget.src==='http://localhost/hw1/images/heart_red.png')
    {
        const evento_id = event.currentTarget.id;
        console.log('rimuovo');
        event.currentTarget.src="../images/heart_white.png";
        const id = encodeURI(evento_id); 
        const url = "http://localhost/hw1/php/rimuoviLike.php"; 
        const formData = new FormData();
        formData.append('prova',id);
        fetch(url, {method:'POST' , body: formData}).then(likeResponse).then(likeJosn); 
    }

    else
    {
        const evento_id = event.currentTarget.id;
        event.currentTarget.src="../images/heart_red.png";
        const id = encodeURI(evento_id); 
        const url = "http://localhost/hw1/php/aggiungiLike.php"; 
        const formData = new FormData();
        formData.append('prova',id);
        fetch(url, {method:'POST' , body: formData}).then(likeResponse).then(likeJosn); 
    }
} 

function likeResponse(response)
{
    return response.json; 
}

function likeJosn(json)
{
    //console.log('ok aggiunto mi piace');
    aggiornamentoLike(); // controlla il numero di like e lo aggiorna
}







/* -------------------- CHECK LIKE OPERE  -------------------- */


const url_check_like = 'http://localhost/hw1/php/checkLike.php';

fetch(url_check_like).then(checkLikeResponse).then(checkLikeJson); 

function checkLikeResponse(response)
{
    return response.json(); 
}

function checkLikeJson(json)
{
    //console.log('json è:');
   // console.log(json);
    const num_results = json.length; 
    //console.log('id vale: '); 
    for(let i = 0; i<num_results ; i++)
    {
        const likes_img = document.querySelectorAll('.like'); 
        for(const like of likes_img )
        {
            if(like.id===json[i].idOpera)
            {
                like.src='../images/heart_red.png';
            }
        }
        
    }
}










/* -------------------- AGGIORNAMENTO LIKE OPERE  -------------------- */


function aggiornamentoLike()
{
    fetch(url_opere_utente).then(aggiornamentoLikeResponse).then(aggiornamentoLikeJson); 
}

function aggiornamentoLikeResponse(response)
{
    return response.json(); 
}

function aggiornamentoLikeJson(json)
{
    //console.log(json);
    const num_results= json.length; 
    const numbers =  document.querySelectorAll('.number_like');
    for(let i = 0; i<num_results ; i++)
    {
        for(const number of numbers)
        {   
            if(number.id ===json[i].idOpera)
            {
                number.textContent='';
                number.textContent=json[i].likes;
            }
        }
    }
}


/* -------------------- check preferiti --------------------*/ 



function preferiti(event)
{

    console.log(event.currentTarget.src);

    if(event.currentTarget.src==='http://localhost/hw1/images/star_yellow.png')
    {
        const evento_id = event.currentTarget.id;
        console.log('rimuovo');
        event.currentTarget.src="../images/star.png";
        const id = encodeURI(evento_id); 
        const url = "http://localhost/hw1/php/rimuoviPreferiti.php"; 
        const formData = new FormData();
        formData.append('preferiti',id);
        fetch(url, {method:'POST' , body: formData}).then(preferitoResponse).then(preferitoJson); 
    }

    else
    {
        const evento_id = event.currentTarget.id;
        event.currentTarget.src="../images/star_yellow.png";
        const id = encodeURI(evento_id); 
        const url = "http://localhost/hw1/php/aggiungiPreferiti.php"; 
        const formData = new FormData();
        formData.append('preferiti',id);
        fetch(url, {method:'POST' , body: formData}).then(preferitoResponse).then(preferitoJson); 
    }
   
} 

function preferitoResponse(response)
{
    return response.json; 
}

function preferitoJson(json)
{
    console.log(json);
}





/* -------------------- AGGIORNAMENTO PREFERITI OPERE  -------------------- */



const url_check_preferiti = 'http://localhost/hw1/php/checkPreferiti.php';

fetch(url_check_preferiti).then(checkPreferitoResponse).then(checkPreferitoJson); 

function checkPreferitoResponse(response)
{
    return response.json(); 
}

function checkPreferitoJson(json)
{    
    const num_results = json.length; 
    for(let i = 0; i<num_results ; i++)
    {
        const stars_img = document.querySelectorAll('.star'); 
        for(const star of stars_img)
        {
            if(star.id===json[i].idOpera)
            {
                star.src='../images/star_yellow.png';
            }
        }
        
    }
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

    const carica_opera = document.createElement('a'); 
    carica_opera.textContent='Carica Opera'; 
    carica_opera.href='http://localhost/hw1/php/caricaOpera.php'; 
    carica_opera.classList.add('link_menu');

    const logout = document.createElement('a'); 
    logout.textContent='Logout'; 
    logout.href='http://localhost/hw1/php/logout.php'; 
    logout.classList.add('link_menu');

    const home = document.createElement('a'); 
    home.textContent='Logout'; 
    home.href='http://localhost/hw1/php/logout.php'; 
    home.classList.add('link_menu');

    const close = document.createElement('img'); 
    close.src="../images/close.png";
    close.classList.add('close_modale');

    modale_menu.appendChild(close); 
    modale_menu.appendChild(div_link); 
    div_link.appendChild(curiosità);
    div_link.appendChild(carica_opera);
    div_link.appendChild(logout);

    close.addEventListener('click', closeModaleMenu); 
}


function closeModaleMenu(event)
{
    const modale_menu = document.querySelector('#modal-view-menu');
    modale_menu.innerHTML='';
    modale_menu.classList.add('hidden');
}