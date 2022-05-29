
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

/* ------------------ CARICAMENTO OPERE UTENTE ------------------*/

const url_opere_utente = 'http://localhost/hw1/php/caricamentoDatiUtenti.php';
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

            const link = document.createElement('a'); 
            link.setAttribute( "href", "http://localhost/hw1/php/linkOpera.php", "id", json[i].idOpera);
            link.classList.add('link');

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
            src_immagine_profilo.src = "data:image/jpeg;base64,"+json[i].immagineProfiloUtente;
            src_immagine_profilo.classList.add('picture-profile_utente'); 

            const username_utente_opera = document.createElement('span'); 
            username_utente_opera.classList.add('titolo_opera');
            username_utente_opera.textContent=json[i].username; 

            const contenitore_immagine_opera = document.createElement('div'); 
            contenitore_immagine_opera.classList.add('contenitore_immagine'); 
        
            const immagine_opera = document.createElement('img');
            immagine_opera.src="data:image/jpeg;base64,"+json[i].srcImmagineOpera;
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

            const commenti = document.createElement('span'); 
            commenti.textContent=json[i].commenti;

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
            div_like.appendChild(commenti);

            heart.addEventListener('click', prova);
            star.addEventListener('click', preferiti);
            immagine_opera.addEventListener('click', anteprima); 
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


/* -------------------- ANTEPRIMA MODALE -------------------- */

const modale = document.getElementById('modal-view'); 

function anteprima(event)
{
    
    modale.classList.remove('hidden');
    console.log(event.currentTarget.id);

    const url = 'http://localhost/hw1/php/caricamentoOpera.php'; 
    const id = event.currentTarget.id;
    const formData = new FormData();
    formData.append('anteprima',id);
    fetch(url, {method:'POST' , body: formData}).then(anteprimaResponse).then(anteprimaJson); 
}




function anteprimaResponse(response)
{
    return response.json(); 
}

function anteprimaJson(json)
{
    console.log(json);
    
    const contenitore_totale_modale = document.createElement('div'); 
    contenitore_totale_modale.classList.add('contenitore_totale_modale');

    const contenitore_immagine_opera = document.createElement('div'); 
    contenitore_immagine_opera.classList.add('contenitore_immagine_anteprima');

    const info_opera_anteprima = document.createElement('div'); 
    info_opera_anteprima.classList.add('info_opera_anteprima');
    
      

    const close = document.createElement('img'); 
    close.src="../images/close.png";
    close.classList.add('close_modale');
    
    const image_opera = document.createElement('img'); 
    image_opera.src="data:image/jpeg;base64,"+json[0].immagineOpera; 
    image_opera.classList.add('image_opera_anteprima');

    const div_anteprima = document.createElement('div'); 
    div_anteprima.classList.add('div_anteprima');

    const info_opera_modale = document.createElement('div'); 
    info_opera_modale.classList.add('info_opera_modale'); 

    const immagine_profilo_modale = document.createElement('img'); 
    immagine_profilo_modale.src ="data:image/jpeg;base64,"+json[0].immagineProfilo; 
    immagine_profilo_modale.classList.add('immagine_profilo_modale'); 

    const username = document.createElement('span'); 
    username.textContent='@'+json[0].username;


    const span_immagine_autore = document.createElement('span'); 
    span_immagine_autore.classList.add('span_immagine_autore'); 

    const span = document.createElement('span');
    span.classList.add('info_utente_opera'); 

    const heart = document.createElement('img');
    heart.src="../images/heart_white.png"; 
    heart.classList.add('like_modale'); 
    heart.id = json[0].idOpera;

    const like = document.createElement('span'); 
    like.textContent=json[0].likes;
    like.id=json[0].idOpera;
    like.classList.add('number_like_modale'); 

    const div_like = document.createElement('div'); 
    div_like.classList.add('div_like');

    const star = document.createElement('img');
    star.src="../images/star.png"; 
    star.classList.add('star_modale'); 
    star.id = json[0].idOpera;

    const comment = document.createElement('img');
    comment.src="../images/sms.png"; 
    comment.classList.add('comment_modale'); 
    comment.id = json[0].idOpera;
    // console.log('id è ' +comment.id); 

    const div_commenti = document.createElement('div'); 
    div_commenti.id=json[0].idOpera;
    div_commenti.classList.add('commenti_modale'); 
    
    const numero_commenti = document.createElement('span'); 
    numero_commenti.textContent=json[0].commenti;
    numero_commenti.classList.add('number_like_modale');
    
    modale.appendChild(close); 
    modale.appendChild(div_anteprima);
    div_anteprima.appendChild(contenitore_totale_modale); 
   // contenitore_totale_modale.appendChild(contenitore_immagine_opera);
    contenitore_totale_modale.appendChild(info_opera_anteprima);
    info_opera_anteprima.appendChild(contenitore_immagine_opera); 
    contenitore_immagine_opera.appendChild(image_opera); 
    
 

    contenitore_totale_modale.appendChild(info_opera_modale); 
    info_opera_modale.appendChild(span_immagine_autore); 
    span_immagine_autore.appendChild(immagine_profilo_modale);
    span_immagine_autore.appendChild(username);
    info_opera_modale.appendChild(span); 

    span.appendChild(star);
    span.appendChild(div_like);
    div_like.appendChild(heart);
    div_like.appendChild(like); 
    span.appendChild(comment);
    span.appendChild(numero_commenti);
     

    contenitore_totale_modale.appendChild(div_commenti);

    heart.addEventListener('click', prova);
    star.addEventListener('click', preferiti);
    comment.addEventListener('click', commenti);
    close.addEventListener('click', closeModale); 
    //chiudo la modale


    fetch(url_check_like).then(checkLikeModaleResponse).then(checkLikeModaleJson); 
    fetch(url_check_preferiti).then(checkPreferitoModaleResponse).then(checkPreferitoModaleJson); 
}


function closeModale(event)
{
    console.log('chiudo la modale');
    fetch(url_check_like).then(checkLikeResponse).then(checkLikeJson); 
    fetch(url_check_preferiti).then(checkPreferitoResponse).then(checkPreferitoJson); 
    const modale = document.getElementById('modal-view');
    modale.innerHTML='';
    modale.classList.add('hidden');
}



function commenti(event)
{
    
    const evento_id = event.currentTarget.id;
    const id = encodeURI(evento_id); 
    const url = "http://localhost/hw1/php/checkCommenti.php"; 
    const formData = new FormData();
    formData.append('commenti',id);
    console.log(id);
    fetch(url, {method:'POST' , body: formData}).then(commentiResponse).then(commentiJson);
}

function commentiResponse(response)
{
    return response.json(); 
}

function commentiJson(json)
{
    console.log(json);

    let num_results = json.length;
    //console.log(json);

    const div_commenti = document.querySelector('.commenti_modale');

   if(num_results !== 0)
   {
        for(let i = 0; i<num_results ; i++)
        {   
            

            const div_contenitore_commento = document.createElement('div'); 
            div_contenitore_commento.classList.add('contenitore_commento');

            const contenitore_immagine_username = document.createElement('div'); 
            contenitore_immagine_username.classList.add('contenitore_immagine_username');

            const immagine_profilo = document.createElement('img'); 
            immagine_profilo.classList.add('picture_profile_utente_modale');
            immagine_profilo.src="data:image/jpeg;base64,"+json[i].immagineProfilo;

            const username = document.createElement('h6'); 
            username.textContent=json[i].username; 
            username.classList.add('username_commenti_modale'); 

            const span = document.createElement('span'); 
            span.classList.add('contenitore_username');

            const contenuto_commento = document.createElement('p'); 
            contenuto_commento.textContent=json[i].commento; 

            div_commenti.appendChild(div_contenitore_commento);
            div_contenitore_commento.appendChild(contenitore_immagine_username);
            contenitore_immagine_username.appendChild(immagine_profilo); 
            contenitore_immagine_username.appendChild(username);  
            div_contenitore_commento.appendChild(contenuto_commento);
        }
    }
    const form = document.createElement('form') ;
    form.setAttribute("method", "post");
    form.setAttribute("action", "InserisciCommento.php");

    const commento = document.createElement("input");
    commento.setAttribute("type", "text");
    commento.setAttribute("name", "commento");
    commento.setAttribute("placeholder", "  Inserisci un commento...");
    commento.classList.add('commento');

    const id = document.createElement("input");
    id.classList.add('hidde'); 
    id.setAttribute("name", "idOpera");
    id.setAttribute("value", json[0].idOpera);

    const s = document.createElement("input");
    s.setAttribute("type", "submit");
    s.setAttribute("value", "Invia");
    s.classList.add('button_commenti');


    div_commenti.appendChild(form); 
    form.appendChild(commento);
    form.appendChild(id);
    form.appendChild(s); 
    s.addEventListener('submit', inserimentoCommento);

    
}

function inserimentoCommento(event)
{

}

function checkLikeModaleResponse(response)
{
    return response.json(); 
}

function checkLikeModaleJson(json)
{
    //console.log('json è:');
    // console.log(json);
    const num_results = json.length; 
    //console.log('id vale: '); 
    for(let i = 0; i<num_results ; i++)
    {
        const likes_img = document.querySelectorAll('.like_modale'); 
        for(const like of likes_img )
        {
            if(like.id===json[i].idOpera)
            {
                like.src='../images/heart_red.png';
            }
        }

    }
}



function checkPreferitoModaleResponse(response)
{
    return response.json(); 
}

function checkPreferitoModaleJson(json)
{    
    const num_results = json.length; 
    for(let i = 0; i<num_results ; i++)
    {
        const stars_img = document.querySelectorAll('.star_modale'); 
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