<html>
<head>
   <title>The Materialize Selects Example</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">      
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
   <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
   <script>
      $(document).ready(function() {
         $('select').material_select();
      });
   </script>
</head>
<body class="container">   
   <div class="row section">
    <div class="col">
     <!-- Modal Trigger -->
     <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>
     <p>You have to include jQuery and Materialize JS + CSS for the modal to work. You can include it from <a href="http://materializecss.com/getting-started.html">CDN (getting started)</a>.
     </div>
  </div>
  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
     <h4>Modal Header</h4>
     <p>A bunch of text</p>
  </div>
  <div class="modal-footer">
     <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
  </div>
</div>
<script>
      $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});
</script>      			
</body>   
</html>