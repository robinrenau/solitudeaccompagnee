/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';
import 'bootstrap';
import axios from 'axios';


// code pour l'ajax participation
document.querySelectorAll('a.js-participation').forEach(function(link){
    function OnClickBtnParticipation(event){
        event.preventDefault();
        const url = this.href;
        const spanCount2 = document.querySelector('span#js-participations');
        const icone = this.querySelector('i');

        axios.get(url).then(function(response){

            spanCount2.textContent = response.data.participations;

            if(icone.classList.contains('fa-times-circle'))
                icone.classList.replace('fa-times-circle','fa-check-circle');
            else
                icone.classList.replace('fa-check-circle','fa-times-circle' )
        }).catch(function (error) {
            if (error.response.status=== 403){
                window.alert("Vous ne pouvez pas participer à un évenement si vous n'êtes pas connecté")
            } else{
                window.alert("Une erreur s'est produite, veuillez réessayer plus tard")
            }

        });
    }
    link.addEventListener('click', OnClickBtnParticipation)
});


// Code upload photo profil
$('.dropdown-toggle').dropdown();
$('.custom-file-input').on('change', function(event) {
    var inputFile = event.currentTarget;
    $(inputFile).parent()
        .find('.custom-file-label')
        .html(inputFile.files[0].name);
});


