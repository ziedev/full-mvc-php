window.onload = () => {
    let boutons = document.querySelectorAll(".form-check-input");
    for (let bouton of boutons){
        bouton.addEventListener("click",activer);
    }
}

function activer(){
    let xmlhttp = new XMLHttpRequest;
    
    xmlhttp.open("GET","/admin/activeannonces/"+this.dataset.id);

    xmlhttp.send();


}