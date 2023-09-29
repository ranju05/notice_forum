

        
    let menuBar = document.getElementById("menu_bar");
    function toggleMenu(){
        menuBar.classList.toggle("open_menu");
    }

function slideNext(){
    let currentImage = document.getElementById("slider").src;
    let find_last_name = currentImage.lastIndexOf("/");
    let img = currentImage.substring(find_last_name + 1);
    let index = images.indexOf(img);
    if(index < images.length - 1){
    document.getElementById("slider").src = "uploads/" + images[index +1];
    document.getElementById("resource").href = "uploads/" + images[index +1];

    }
    else{
    document.getElementById("slider").src = "uploads/" + images[0];
    document.getElementById("resource").href = "uploads/" + images[0];
    }

}

function slidePrev(){
    let currentImage = document.getElementById("slider").src
    let find_last_name = currentImage.lastIndexOf("/");
    let img = currentImage.substring(find_last_name + 1);
    let index = images.indexOf(img);
    
    if(index > 0){
    document.getElementById("slider").src = "uploads/" + images[index - 1];
    document.getElementById("resource").href = "uploads/" + images[index - 1];
    }
    else{
    document.getElementById("slider").src = "uploads/" + images[0];
    document.getElementById("resource").href = "uploads/" + images[0];
    
    }

}

function changeImage(){
    let currentImage = document.getElementById("slider").src
    let find_last_name = currentImage.lastIndexOf("/");
    let img = currentImage.substring(find_last_name + 1);
    let index = images.indexOf(img);
    
    if(index < images.length -1){
    document.getElementById("slider").src = "uploads/" + images[index + 1];
    document.getElementById("resource").href = "uploads/" + images[index + 1];
    }
    else{
    document.getElementById("slider").src = "uploads/" + images[0];
    document.getElementById("resource").href = "uploads/" + images[0];
    
    }
    setTimeout(changeImage, 3000);
    
    
}
changeImage();
