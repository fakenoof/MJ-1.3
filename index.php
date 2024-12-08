<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
           
    
          
    
           
           * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
   }
   .c {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
   }
   .navbar {
    background-color: #ffffff;
    border-bottom: 1px solid #dddfe2;
    display: flex;
    justify-content: space-around;
    padding: 10px;
    background-color: white;
    border-top: 1px solid #ccc;
   }
   
   
   .navbar .nav-links {
    display: flex;
    text-align: center;
    list-style-type: none;
   }
   
   .navbar .nav-links li {
    margin-right: 15px;
   }
   
   .navbar .nav-links a {
    text-decoration: none;
    color: rgb(33, 8, 8);
    font-size: 25px;
    padding: 10px;
   }
   
   .navbar .nav-links a.active {
    border-bottom: 3px solid #1877f2;
    font-weight: bold;
   }

   .navbar .dropdown {
            position: relative;
        }
        .navbar .dropdown-content {
            display: none;
            position: absolute;
            top: 40px;
            left: 0;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            z-index: 1000;
        }
        .navbar .dropdown-content a {
            color: #333;
            padding: 10px 20px;
            text-decoration: none;
            display: block;
            font-size: 16px;
        }
        .navbar .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .navbar .dropdown:hover .dropdown-content {
            display: block;
    
        }
            
        </style>
   </head>
   <body class="c">
   
       <div class="container">
           <header>
               <div class="navbar">
                   <ul class="nav-links">
                       <li><a href="/" class="active" >Home</a></li>
                       <li><a href="About/about.php">About</a></li>
                       <li class="dropdown">
                        <a href="Menu/menu.php">Menus</a>
                        <div class="dropdown-content">
                        <a href="Menu/menu.php" >Menu</a>
                        <a href="Dessert/dessert.php" >Dessert</a>
                        <a href="Drinks/drinks.php">Drinks</a>
                        <a href="Decoration/design.php">Decoration</a>
                        </div>
                      
                   </ul>
               </div>
           </header>
 <br><br>
        <div class="sha">
            <div class="men_text">
                <h1 style="font-size: 90px;">Welcome to</h1>
                <h1> Mang Jhonny Catering</h1>
            </div><br><br>
            <div class="main_image">
                <img src="image/main.jpg">
            </div>
        </div>
        <div class="main_btn"> 
            <a href="Menu/menu.php">See Our Menus</a>
            <i class="fa-solid fa-angle-right"></i>
        </div><br><br>
       
    
        

      

<script src="script.js"></script>
   
    
</body>
</html>