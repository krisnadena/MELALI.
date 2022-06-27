
<style>
/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
.scroll{
    display:block;
    padding:5px;
    margin-top:5px;
    width:300px;
    height:50px;
    overflow:scroll;
}
</style>
<button class="open-button" onclick="openForm()">Chat</button>

<div class="chat-popup" id="myForm">
<div class="card " style="width: 30rem; height:30rem;">
  <h5 class="card-header">chat bot</h5>
  <div class="card-body scroll " id="textnya">
    <p class="card-text">Chatbot: Selamat datang di chatbot</p>
     </div>
  <div class="card-footer">
  <form id="form-input">
    <div class="form-group">
        <label for="exampleInputEmail1">pesan</label>
        <input type="text" class="form-control" id="message" name="message" placeholder="Input pesan">
    </div>
    <button type="submit" id="tombol-simpan" class="btn-sm btn-primary">Submit</button>
    <button  class="btn-sm btn-danger" onclick="closeForm();">batal</button>
</form>
  </div>
</div>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>

    <script>
        var text= document.getElementById('textnya');
        $("#tombol-simpan").click(function () {
            //validasi form
            $('#form-input').validate({
                rules: {
                    message: {
                        required: true
                    }
                },
                //jika validasi sukses maka lakukan
                submitHandler: function (form) {
                    //membuat object form untuk mengirim data secara serialize
                    $("#textnya").append("<p class='card-text'>user : "+$("#message").val()+"</p>");
                    $.ajax({
                        type: 'POST',
                        url: "https://paorbittourism.herokuapp.com/chat",
                        data: $('#form-input').serialize(),
                        success: function (data) {
                            $('#textnya').append('<p class="card-text">Chatbot: '+data.data+'</p>');
                        }
                    });
                    //kosongkan form nama dan jurusan
                    document.getElementById("message").value = "";
                    
                    return false;
                }
            });
        });

        //fungsi tampil data
    
    </script>


