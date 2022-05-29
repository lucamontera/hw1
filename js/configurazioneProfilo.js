function anteprimaImmagine(event)
{

 const immagine_anteprima = document.querySelector('#anteprima');
 const src = URL.createObjectURL(event.target.files[0]);
 immagine_anteprima.classList.remove('hidden');
 immagine_anteprima.classList.add('circle')

 console.log(event.currentTarget.files);

 immagine_anteprima.src=src;

    
}





const url = 'http://localhost/hw1/php/caricamentoDatiUtente.php';
fetch(url).then(datiResponse).then(datiJson); 

function datiResponse(response)
{
    return response.json(); 
}

const picture_profile = document.querySelector('.picture-profile'); 

function datiJson(json)
{
    picture_profile.src="data:image/jpeg;base64,"+json[0].immagineProfilo;
}
