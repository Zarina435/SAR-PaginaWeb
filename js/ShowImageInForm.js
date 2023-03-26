function getImagePreview(event) {
    //Create image
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('preview');
    var newimg= document.createElement('img');
    newimg.className = "img"
    newimg.height = 225;
    newimg.width = 225;
    newimg.src=image; //Load image into website
    //Check if there is one image, if there is remove current image
    if(imagediv.hasChildNodes()){
      imagediv.removeChild(imagediv.firstChild);
    }
    imagediv.appendChild(newimg);
  }
  function resetImg() {
    const  imagen = document.querySelector(".img");
    imagen.remove();
    document.getElementById("inpFile").value="";
  }
  function resetImgFile() {
    document.getElementById("inpFile").value="";
  }