<html>
<head>
  <meta charset="utf8">
  <style>
    #epiceditor-utilbar{
      background-color: black;
      position: absolute;
      bottom: 0em;
      z-index: 1000;
    }

    #my-edit-area {
      display: none;
    }
  </style>
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/epiceditor/0.2.2/js/epiceditor.js"></script>
  <script>
    $(document).ready(function(){;
      var editor = new EpicEditor({
        textarea: "my-edit-area",
        theme: {
          base: 'http://cdnjs.cloudflare.com/ajax/libs/epiceditor/0.2.2/themes/base/epiceditor.css',
          preview: 'http://cdnjs.cloudflare.com/ajax/libs/epiceditor/0.2.2/themes/preview/github.css',
          editor: 'http://cdnjs.cloudflare.com/ajax/libs/epiceditor/0.2.2/themes/editor/epic-light.css'
        },
        button: {
          preview: true,
          fullscreen: false,
          bar: "show"
        },
        autogrow: {
          minHeight: '300px'
        }
      }).load();

      $('#show-result').on('click', function(){
        var result = $('#my-edit-area').val();
        console.log(result);
      });
    });
  </script>
</head>
<body>
<div class="container">
      <div class="starter-template">
  
  

  <div id="epiceditor">
  <form method="post" >
  <input type="text" class="form-control" placeholder="Title" name="title" required>
  <?php
require 'class/bdd.php';
if(isset($_POST['document'])){
	$sql = 'SELECT text FROM texts WHERE id ='.$_POST['document'].'';
	$req=$cnx->prepare($sql);
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_ASSOC);	
	echo ("<textarea id='my-edit-area' name='my-edit-area'>");
	echo $data[0]['text'];
	echo ("</textarea>");
	}
	else
	{
		echo ("<textarea id='my-edit-area' name='my-edit-area'>");
		echo ("#Inserer votre texte ici !");
		echo ("</textarea>");
	}
	?>
	
 </form>
  </div>
  </div>

    </div>

</body>
</html>