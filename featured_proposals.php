<?php

session_start();

require_once("includes/db.php");

require_once("functions/functions.php");

?>
<!DOCTYPE html>

<html lang="en" class="ui-toolkit">

<head>
<title> <?php echo $site_name; ?> - Featured Proposals/services </title>
<meta name="description" content="">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="<?php echo $get_site_author; ?>">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet">
<link href="styles/bootstrap.css" rel="stylesheet">
<link href="styles/custom.css" rel="stylesheet"> <!-- Custom css code from modified in admin panel --->
<link href="styles/styles.css" rel="stylesheet">
<link href="styles/categories_nav_styles.css" rel="stylesheet">
<link href="font_awesome/css/font-awesome.css" rel="stylesheet">
<link href="styles/sweat_alert.css" rel="stylesheet">
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser -->
<script src="js/ie.js"></script>
<script type="text/javascript" src="js/sweat_alert.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<?php if(!empty($site_favicon)){ ?>
<link rel="shortcut icon" href="images/<?php echo $site_favicon; ?>" type="image/x-icon">
<?php } ?>
</head>
<body class="bg-white is-responsive">
<?php require_once("includes/header.php"); ?>
<div class="container-fluid mt-5"><!-- Container start -->
  <div class="row">
    <div class="col-md-12">
      <center>
      <h1> Featured Proposals/Services </h1>
      <p class="lead">This is an extended list of our top featured proposals/services</p>
      </center>
      <hr class="mt-5 pt-2">
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-lg-3 col-md-4 col-sm-12 <?=($lang_dir == "right" ? 'order-2 order-sm-1':'')?>">
      <?php require_once("includes/featured_sidebar.php"); ?>
    </div>
    <div class="col-lg-9 col-md-8 col-sm-12 <?=($lang_dir == "right" ? 'order-1 order-sm-2':'')?>">
      <div class="row flex-wrap" id="featured_proposals">
      <?php get_featured_proposals(); ?>
      </div>
      <div id="wait"></div>
      <br>
      <div class="row justify-content-center mb-5 mt-0"><!-- row justify-content-center Starts -->
        <nav><!-- nav Starts -->
          <ul class="pagination" id="featured_pagination">
          <?php get_featured_pagination(); ?>
          </ul>
        </nav><!-- nav Ends -->
      </div>
    </div>
  </div>
</div><!-- Container ends -->
<?php require_once("includes/footer.php"); ?>
<script>
function get_featured_proposals(){
  var sPath = '';
  var aInputs = Array();
  var aInputs = $('li').find('.get_online_sellers');
  var aKeys   = Array();
  var aValues = Array();
  iKey = 0;
  $.each(aInputs,function(key,oInput){
  if(oInput.checked){
  aKeys[iKey] =  oInput.value
  };
  iKey++;
  });
  if(aKeys.length>0){
  var sPath = '';
  for(var i = 0; i < aKeys.length; i++){
  sPath = sPath + 'online_sellers[]=' + aKeys[i]+'&';
  }
  }
  var aInputs = $('li').find('.get_cat_id');
  var aKeys   = Array();
  var aValues = Array();
  iKey = 0;
  $.each(aInputs,function(key,oInput){
  if(oInput.checked){
  aKeys[iKey] = oInput.value
  };
  iKey++;
  });
  if(aKeys.length>0){
  for(var i = 0; i < aKeys.length; i++){
  sPath = sPath + 'cat_id[]=' + aKeys[i]+'&';
  }
  }
  var aInputs = $('li').find('.get_delivery_time');
  var aKeys   = Array();
  var aValues = Array();
  iKey = 0;
  $.each(aInputs,function(key,oInput){
  if(oInput.checked){
  aKeys[iKey] =  oInput.value
  };
  iKey++;
  });
  if(aKeys.length>0){
  for(var i = 0; i < aKeys.length; i++){
  sPath = sPath + 'delivery_time[]=' + aKeys[i]+'&';
  }
  }
  var aInputs = Array();
  var aInputs = $('li').find('.get_seller_level');
  var aKeys   = Array();
  var aValues = Array();
  iKey = 0;
  $.each(aInputs,function(key,oInput){
  if(oInput.checked){
  aKeys[iKey] =  oInput.value
  };
  iKey++;
  });
  if(aKeys.length>0){
  for(var i = 0; i < aKeys.length; i++){
  sPath = sPath + 'seller_level[]=' + aKeys[i]+'&';
  }
  }
  var aInputs = Array();
  var aInputs = $('li').find('.get_seller_language');
  var aKeys   = Array();
  var aValues = Array();
  iKey = 0;
  $.each(aInputs,function(key,oInput){
  if(oInput.checked){
  aKeys[iKey] =  oInput.value
  };
  iKey++;
  });
  if(aKeys.length>0){
  for(var i = 0; i < aKeys.length; i++){
  sPath = sPath + 'seller_language[]=' + aKeys[i]+'&';
  }
  }
  $('#wait').addClass("loader");
  $.ajax({  
  url:"featured_load",  
  method:"POST",  
  data: sPath+'zAction=get_featured_proposals',  
  success:function(data){
  $('#featured_proposals').html('');  
  $('#featured_proposals').html(data); 
  $('#wait').removeClass("loader");
  }  
  });               
  $.ajax({  
  url:"featured_load",  
  method:"POST",  
  data: sPath+'zAction=get_featured_pagination',  
  success:function(data){  
  $('#featured_pagination').html('');  
  $('#featured_pagination').html(data); 
  }  
  });
  }

  $('.get_online_sellers').click(function(){ 
  get_featured_proposals(); 
  });
  $('.get_cat_id').click(function(){ 
  get_featured_proposals(); 
  });
  $('.get_delivery_time').click(function(){ 
  get_featured_proposals(); 
  });
  $('.get_seller_level').click(function(){ 
  get_featured_proposals(); 
  });
  $('.get_seller_language').click(function(){ 
  get_featured_proposals(); 
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".get_cat_id").click(function(){
      if($(".get_cat_id:checked").length > 0 ) {
        $(".clear_cat_id").show();
      }
      else{
        $(".clear_cat_id").hide();
      }
    });
    $(".get_delivery_time").click(function(){
      if($(".get_delivery_time:checked").length > 0 ) {
        $(".clear_delivery_time").show();
      }
      else{
        $(".clear_delivery_time").hide();
      }
    });
    $(".get_seller_level").click(function(){
      if($(".get_seller_level:checked").length > 0 ) {
        $(".clear_seller_level").show();
      }
      else{
        $(".clear_seller_level").hide();
      }
    });
    $(".get_seller_language").click(function(){
      if($(".get_seller_language:checked").length > 0 ) {
        $(".clear_seller_language").show();
      }
      else{
        $(".clear_seller_language").hide();
      }
    });
    $(".clear_cat_id").click(function(){
      $(".clear_cat_id").hide();
    });
    $(".clear_delivery_time").click(function(){
      $(".clear_delivery_time").hide();
    });
    $(".clear_seller_level").click(function(){
      $(".clear_seller_level").hide();
    });
    $(".clear_seller_language").click(function(){
      $(".clear_seller_language").hide();
    });
  });
  function clearCat(){
    $('.get_cat_id').prop('checked',false);
    get_featured_proposals(); 
  }
  function clearDelivery(){
    $('.get_delivery_time').prop('checked',false);
    get_featured_proposals(); 
  }
  function clearLevel(){
    $('.get_seller_level').prop('checked',false);
    get_featured_proposals(); 
  }
  function clearLanguage(){
    $('.get_seller_language').prop('checked',false);
    get_featured_proposals(); 
  }
</script>
</body>
</html>