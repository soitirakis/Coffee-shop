<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <title>Coffee Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inconsolata" >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgdNNgaOgBcDrjUZSeMtL1OEJ1QWy7TuM&callback=initMap">
</script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="main.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
  <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <script>

  window.onload = function(){
    let now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById("reserve").value = now.toISOString().slice(0,16);
 }


/*
 disable previous dates

  $(document).ready(function () {
    var minDate = new Date();
    $("#reserve").datepicker({
      showAnim:"drop",
      numberOfMonth: 1,
      minDate: minDate,
      dateFormat: "dd/mm/yy hh:mm"
    });
  })
*/
  </script>
</head>
<body
  <header>
    <nav class="navbar fixed-top navbar-expand-md navbar-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav col-sm-12">
          <li class="nav-item col-sm-3 text-center">
            <a class="nav-link" href="#home">HOME</a>
          </li>
          <li class="nav-item col-sm-3 text-center">
            <a class="nav-link" href="#about">ABOUT</a>
          </li>
          <li class="nav-item col-sm-3 text-center">
            <a class="nav-link" href="#menu">MENU</a>
          </li>
          <li class="nav-item col-sm-3 text-center">
            <a class="nav-link" href="#where">WHERE</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- home container -->
  <div class="bg" id="home">
    <div class="text-l">
      Open from 6am to 5pm
    </div>
    <div class="text-c">
      the </br>
      cafe
    </div>
    <div class="text-r">
      15 Adr street, 5015
    </div>
  </div>

  <!-- about container -->
    <div class="container" id="about">
      <div class="row">
        <div class="about d-flex flex-column justify-content-center">
          <h3 class="h3 text-center" >ABOUT THE CAFE</h3>
          <p>The Cafe was founded in blabla by Mr. Smith in lorem ipsum dolor sit
            amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <p>In addition to our full espresso and brew bar menu, we serve fresh
              made-to-order breakfast and lunch sandwiches, as well as a selection
              of sides and salads and other good stuff.</p>
          <div class="citat">
            <p><cite>" Use products from nature for what it's worth - but never too
              early, nor too late." Fresh is the new sweet.</cite></p>
            <p>Chef, Coffeeist and Owner: Liam Brown</p>
          </div>
          <img src="img/coffee.jpg" class="img-fluid">
          <p><strong>Opening hours:</strong> everyday from 6am to 5pm</p>
          <p><strong>Address</strong> 15 Adr street, 5015, NY</p>
        </div>
      </div>
    </div>

    <!-- menu container -->
    <div class="container" id="menu">
      <div class="row">
        <div class="about d-flex flex-column justify-content-center">
          <h3 class="h3 text-center" >THE MENU</h3>
          <div class="tab">
            <a href="javacript:void(0)" class="col-sm-6 tablinks active" onclick="openMenu(event, 'eat');">
              Eat
            </a>
            <a href="javacript:void(0)" class="col-sm-6 tablinks" onclick="openMenu(event, 'drinks');">
              Drinks
            </a>
          </div>
          <div class="card">
            <div class="card-body tabcontent" id="eat">
              <h4 class="card-title">Bread Basket</h4>
              <p class="card-text">Assortment of fresh baked fruit breads and muffins 5.50</p>
              <h4 class="card-title">Honey Almond Granola with Fruits</h4>
              <p class="card-text">Natural cereal of honey toasted oats, raisins, almonds and dates 7.00</p>
              <h4 class="card-title">Belgian Waffle</h4>
              <p class="card-text">Vanilla flavored batter with malted flour 7.50</p>
              <h4 class="card-title">Scrambled eggs</h4>
              <p class="card-text">Scrambled eggs, roasted red pepper and garlic, with green onions 7.50</p>
              <h4 class="card-title">Blueberry Pancakes</h4>
              <p class="card-text">With syrup, butter and lots of berries 8.50</p>
            </div>
            <div class="card-body tabcontent" id="drinks" style="display:none;">
              <h4 class="card-title">Coffe</h4>
              <p class="card-text">Regular coffee 2.50</p>
              <h4 class="card-title">Chocolato</h4>
              <p class="card-text">Chocolato espresso with milk 4.50</p>
              <h4 class="card-title">Corretto</h4>
              <p class="card-text">Whiskey and coffee 5.00</p>
              <h4 class="card-title">Iced tea</h4>
              <p class="card-text">Hot tea, except not hot 3.00</p>
              <h4 class="card-title">Soda</h4>
              <p class="card-text">Coke, Sprite, Fanta, etc. 2.50</p>
            </div>
        </div>
        <img src="img/coffeehouse2.jpg" class="img-fluid">
      </div>
    </div>
  </div>

  <!-- where container -->
  <div class="container" id="where">
    <div class="row">
      <div class="about d-flex flex-column justify-content-center">
        <h3 class="h3 text-center" >WHERE TO FIND US</h3>
        <p class="d-flex flex-column justify-content-left">Find us at some address at some place</p>

        <!-- google map-->
        <div id="map"></div>
        <p><mark>FYI!</mark> We offer full-service catering for any event, large or small. We
          understand your needs and we will cater the food to satisfy the
          biggerst criteria of them all, both look and taste.</p>
        <p><strong>Reserve</strong> a table, ask for today's special or just send us
          a message: </p>

        <!-- reserve form-->
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" name="regForm" onsubmit="return showError();" id="book">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" id="nume" name="nume"><span class="error" aria-live="polite"></span>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="How many people" id="number" name="number_people"><span class="error" aria-live="polite"></span>
          </div>
          <div class="form-group">
            <input type="datetime-local" id="reserve" name="reserve" class="form-control" ><span class="error" aria-live="polite"></span>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Message / Special requirements" name="message" id="message"><span class="error" aria-live="polite"></span>
          </div>
          <button type="submit" class="btn" id="myBtn" onclick="getData();">SEND MESSAGE</button>
        </form>
      </div>
    </div>
  </div>

  <!-- footer-->
  <footer class="d-flex justify-content-center">
    <div class="description">
      <p>Created with <i class="fas fa-coffee"></i> and from the <i class="fas fa-heart"></i></p>
      <p><i class="far fa-copyright"></i>AAC</p>
      <p>Inspired after <a href="https://www.w3schools.com/w3css/tryw3css_templates_cafe.htm" target = "_blank">W3Schools Template</a></p>
    </div>
  </footer>
</body>
</html>
<?php
 include("send_message.php");
?>
