const inputSearch = document.querySelector("[placeholder='search']");
const autocomplete = document.getElementById("autocomplete");
const searchBtn = document.getElementById("searchBtn")
const xhrurl = autocomplete.dataset.xhrurl;
let id_movie = ""; 




// a faire lundi 
/* inputSearch.addEventListener("blur", ()=> {
    doc.innerHTML="";
}); */

inputSearch.addEventListener(
    "keyup",
    (e) => {
        const inputText = e.target.value;
        console.log(` voilà la suite ${inputText} `);
        fetch(xhrurl+"?resulta=" + inputText)
            .then((reponse) => {
                return reponse.json();

            })
            .then((json) => {
                console.dir(json)
                affichage(json);
            })
    }

)

function affichage(json) {
    if (json.length !== 0) {
        autocomplete.innerHTML = "";
        let retour = "";
        json.forEach(element => {

            retour += `<div onclick= "validComplete('${element.title}','${element.id_movie}')"> ${element.title}</div>`;
        });
        autocomplete.innerHTML = retour;
    }else{
        autocomplete.innerHTML = "On a pas trouvé alors cherche ailleurs";
    }

}
function validComplete(value, id){
    console.log(value);
   inputSearch.value =value;
   autocomplete.innerHTML = "";
   retour = "";
   id_movie = id;
}

searchBtn.addEventListener("click",()=>{
    if(id_movie !==""){
        location.href =searchBtn.dataset.xhrurl+"?id_movie="+id_movie;
    }
})