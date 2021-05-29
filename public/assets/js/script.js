/*#################################### 
## GENERAL SCRIPT
######################################*/

/* RENDER IMAGE ON UPLOAD */
function handleFiles(files) {
  var imageType = /^image\//;
  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    if (!imageType.test(file.type)) {
      alert("veuillez sélectionner une image");
    } else {
      if (i == 0) {
        preview.innerHTML = '';
      }
      var img = document.createElement("img");
      img.classList.add("obj");
      img.file = file;
      preview.appendChild(img);
      var reader = new FileReader();
      reader.onload = (function (aImg) {
        return function (e) {
          aImg.src = e.target.result;
        };
      })(img);

      reader.readAsDataURL(file);
    }

  }
}

var idvideo = 0;

function onClickAddElementVideo() {
  var x = document.getElementById('admin_trick_videos');
  var y = x.dataset.prototype.replace(/__name__/g,idvideo)
  var fildset = "<span id='video-item-"+ idvideo +"'>" + y + "<button type='button' onclick='onClickRemoveElementVideo("+ idvideo +")' class='btn my-3'>Remove</button></span>";
  x.innerHTML += fildset;
  idvideo++;
}

function onClickAddElement() {
  var x = document.getElementById('create_trick_videos');
  var y = x.dataset.prototype.replace(/__name__/g,idvideo)
  var fildset = "<span id='video-item-"+ idvideo +"'>" + y + "<button type='button' onclick='onClickRemoveElementVideo("+ idvideo +")' class='btn my-3'>Remove</button></span>";
  x.innerHTML += fildset;
  idvideo++;
}

function onClickRemoveElementVideo(i) {
  var x = document.getElementById('video-item-'+ i);
  x.remove();
}
