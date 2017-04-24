<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Grupo La Italiana2</title>
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="owl-carousel/owl.theme.css">

       <!-- CUSTOM STYLE -->
      <link rel="stylesheet" href="css/template-style.css">
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>    
      <script type="text/javascript" src="js/modernizr.js"></script>
      <script type="text/javascript" src="js/responsee.js"></script>
      <script type="text/javascript" src="js/template-scripts.js"></script> 


        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <script src="https://use.fontawesome.com/40d2e93120.js"></script>

        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
      <![endif]-->

        <!-- Styles -->
    </head>
    <body>
    <!--[if lt IE 9]>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <![endif]-->
     <body class="size-1140">
      <!-- TOP NAV WITH LOGO -->
      <header>
         <div id="topbar">
            <div class="line">
               <div class="s-12 m-6 l-6">
                  <p>CONTACTO: <strong(0276)-3484151</strong> | <strong>info@grupolaitaliana.com</strong></p>
               </div>
               <div class="s-12 m-6 l-6">
                  <div class="social right">
                   <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i></button>
  <div id="myDropdown" class="dropdown-content">
    <a href="{{ url('/login') }}">Login</a>
  </div>
</div>
                  </div>
               </div>
            </div>  
         </div> 
         <nav>
            <div class="line">
               <div class="s-12 l-2">
               <img src="img/logotype2.png" style="width:45% ; height:45%" alt=""/>
               </div>
               <div class="top-nav s-12 l-10">
                  <p class="nav-text">Menu</p>
                  <ul class="right">
                     <li class="active-item"><a href="#carousel">Inicio</a></li>
                     <li><a href="#features">Quienes Somos</a></li>
                     <li><a href="#about-us">Servicios</a></li>
                     <li><a href="#our-work">Empleos</a></li>
                     <li><a href="#services">Actualidad</a></li>
                     <li><a href="#contact">Contacto</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>  
      <section>
         <!-- CAROUSEL --> 
         <div id="carousel">
            <div id="owl-demo" class="owl-carousel owl-theme"> 
               <div class="item">
                  <img src="img/first.jpg" alt="">
                  <div class="line"> 
                     <div class="text hide-s">
                        <div class="line"> 
                          <div class="prev-arrow hide-s hide-m">
                             <i class="icon-chevron_left"></i>
                          </div>
                          <div class="next-arrow hide-s hide-m">
                             <i class="icon-chevron_right"></i>
                          </div>
                        </div> 
                        <h2>Free Onepage Responsive Template</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <img src="img/second.jpg" alt="">
                  <div class="line">
                     <div class="text hide-s"> 
                        <div class="line"> 
                          <div class="prev-arrow hide-s hide-m">
                             <i class="icon-chevron_left"></i>
                          </div>
                          <div class="next-arrow hide-s hide-m">
                             <i class="icon-chevron_right"></i>
                          </div>
                        </div> 
                        <h2>Fully Responsive Components</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <img src="img/third.jpg" alt="">
                  <div class="line">
                     <div class="text hide-s">
                        <div class="line"> 
                          <div class="prev-arrow hide-s hide-m">
                             <i class="icon-chevron_left"></i>
                          </div>
                          <div class="next-arrow hide-s hide-m">
                             <i class="icon-chevron_right"></i>
                          </div>
                        </div> 
                        <h2>Build new Layout in 10 minutes!</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- FIRST BLOCK -->
         <div id="first-block">
            <div class="line">
               <h1>Amazing Responsive Business Template</h1>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
               <div class="s-12 m-4 l-2 center"><a class="white-btn" href="#contact">Contact Us</a></div>
            </div>
         </div>
         <!-- FEATURES -->
         <div id="features">
            <div class="line">
               <div class="margin">
                  <div class="s-12 m-6 l-4 margin-bottom" colspan="4">
                     <i class="icon3x"><img src="img/mision.png" style="width: 70%; height: auto; margin: auto auto; margin-top: 15%" ></i>
                     <h2>Misión</h2>
                     <p style="text-align: justify;">Brinda funcional, seguridad, confort, distinción al construir y mantener proyectos civiles, eléctricos, hidráulicos, urbanísticos, metalmecánicos, paisajistas y de telecomunicaciones. Desarrollando procesos efectivos, y talento humano con valores de cordialidad y cooperación para el crecimiento sustentable, basada en la satisfacción del cliente y la generación de progreso en Venezuela.</p>
                  </div>
                  <div class="s-12 m-6 l-4 margin-bottom">
                     <i class="icon3x"><img src="img/vision.png" style="width: 70%; height: auto; margin: auto auto; margin-top: 15%" ></i>
                     <h2>Visión</h2>
                     <p style="text-align: justify;">Competir en mercados internacionales siendo referencia en Venezuela en el sector de la construcción y el mantenimiento industrial, generando bienestar para nuestro talento humano y satisfacción para nuestro cliente con enfoque de calidad total en harmonía y responsabilidad social. </p>
                  </div>
                  <div class="s-12 m-6 l-4 margin-bottom">
                     <i class="icon3x"><img src="img/objetivo.png" style="width: 70%; height: auto; margin: auto auto; margin-top: 15%" ></i>
                     <h2>Objetivo General</h2>
                     <p style="text-align: justify;">Fortalecer nuestra imagen como una organización al cuidado del ambiente, socialmente responsable, motivados para el talento humano y distinguida por calidad del servicio en el sector de la construcción y el mantenimiento industrial, siendo altamente competitiva en el mercado nacional y abarcando mercados internacionales.</p>
                  </div>
               </div>
            </div>
         </div>
         <!-- ABOUT US -->
         <div id="about-us">
            <div class="s-12 m-12 l-6 media-container">
               <img src="img/about.jpg" alt="">
            </div>
            <article class="s-12 m-12 l-6">
               <h2>We are<br> Web Design<br> Heroes</h2>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet 
                 dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit 
                 lobortis nisl ut aliquip ex ea commodo consequat.
               </p>
               <div class="about-us-icons">
                  <i class="icon-paperplane_ico"></i> <i class="icon-trophy"></i> <i class="icon-clock"></i>
               </div>
            </article>
         </div>
         <!-- OUR WORK -->
         <div id="our-work">
            <div class="line">
               <h2 class="section-title">Our Work</h2>
               <div class="tabs">
                  <div class="tab-item tab-active">
                    <a class="tab-label active-btn">Web Design</a>
                    <div class="tab-content">
                      <div class="margin">
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por1.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por4.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por6.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por3.jpg" alt=""></a></div>
                      </div>
                    </div>  
                  </div>
                  <div class="tab-item">
                    <a class="tab-label">Development</a>        
                    <div class="tab-content">
                      <div class="margin">
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por7.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por5.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por1.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por2.jpg" alt=""></a></div>
                      </div>
                    </div>  
                  </div>
                  <div class="tab-item">
                    <a class="tab-label">Social Campaigns</a>
                    <div class="tab-content">
                      <div class="margin">
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por4.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por6.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por3.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por5.jpg" alt=""></a></div>
                      </div>
                    </div>  
                  </div>
                  <div class="tab-item">
                    <a class="tab-label">Photography</a>
                    <div class="tab-content">
                      <div class="margin">
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por7.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por2.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por5.jpg" alt=""></a></div>
                        <div class="s-12 m-6 l-3"><a class="our-work-container lightbox margin-bottom"><div class="our-work-text"><h4>Lorem Ipsum Dolor</h4><p>Laoreet dolore magna aliquam erat volutpat.</p></div><img src="img/por6.jpg" alt=""></a></div>
                      </div>
                    </div>  
                  </div>
               </div>
            </div>
         </div>         
         <!-- SERVICES -->
         <div id="services">
            <div class="line">
               <h2 class="section-title">What we do</h2>
               <div class="margin">
                  <div class="s-12 m-6 l-4 margin-bottom">
                     <i class="icon-vector"></i>
                     <div class="service-text">
                        <h3>We create</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
                  <div class="s-12 m-6 l-4 margin-bottom">
                     <i class="icon-eye"></i>
                     <div class="service-text">
                        <h3>We look to the future</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
                  <div class="s-12 m-12 l-4 margin-bottom">
                     <i class="icon-random"></i>
                     <div class="service-text">
                        <h3>We find a solution</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- LATEST NEWS -->
         <div id="latest-news">
            <div class="line">
              <h2 class="section-title">Latest News</h2> 
              <div class="margin">
                <div class="s-12 m-6 l-6">
                  <div class="s-12 l-2">
                    <div class="news-date">
                      <p class="day">28</p><p class="month">AUGUST</p><p class="year">2015</p>
                    </div>
                  </div>
                  <div class="s-12 l-10">
                    <div class="news-text">
                      <h4>First latest News</h4>
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</p>
                    </div>
                  </div>   
                </div> 
                <div class="s-12 m-6 l-6">
                  <div class="s-12 l-2">
                    <div class="news-date">
                      <p class="day">12</p><p class="month">JULY</p><p class="year">2015</p>
                    </div>
                  </div>
                  <div class="s-12 l-10">
                    <div class="news-text">
                      <h4>Second latest News</h4>
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</p>
                    </div>
                  </div>   
                </div>  
              </div>
            </div>
         </div> 
         <!-- CONTACT -->
         <div id="contact">
            <div class="line">
               <h2 class="section-title">Contactanos</h2>
               <div class="margin">
                  <div class="s-12 m-12 l-3 hide-m hide-s margin-bottom right-align">
                    <img src="img/contact.jpg" alt="">
                  </div>
                  <div class="s-12 m-12 l-4 margin-bottom right-align">
                     <h3>Grupo La Italiana (Licons)</h3>
                     <address>
                        <p><strong>Direccion:</strong>Calle 1, Nº. 9-80 Urbanización Juan de Maldonado, San Cristobal</p>
                        <p><strong>Pais:</strong>Venezuela, Tachira</p>
                        <p><strong>E-mail:</strong> info@grupolaitaliana.com</p>
                     </address>
                     <br />
                     <h3>Social</h3>
                     <p><i class="icon-facebook icon" style="color: #012232"></i> <a href="https://www.facebook.com/grupolaitalianave/">@grupolaitalianave</a></p>
                     <p><i class="icon-instagram icon" style="color: #012232" ></i> <a href="https://www.instagram.com/grupolaitalianave/">@grupolaitalianave</a></p>
                     <p class="margin-bottom"><i class="icon-twitter icon"  style="color: #012232"></i> <a href="https://twitter.com/MyResponsee">@grouplaitaliana</a></p>
                  </div>
                  <div class="s-12 m-12 l-5">
                    <h3>Example contact form (do not use)</h3>
                    <form class="customform" action=form.php method=post>
                      <div class="s-12"><input name="nombre" placeholder="Tu Nombre" title="nombre" type="text" /></div>
                      <div class="s-12"><input name="correo" placeholder="Correo" title="correo" type="text" /></div>
                      <div class="s-12"><input name="telefono" placeholder="Telefono" title="telefono" type="text" /></div>
                      <div class="s-12"><input name="direccion" placeholder="Direccion" title="direccion" type="text" /></div>
                      <div class="s-12"><textarea placeholder="Tu Mensaje" name="text" rows="5"></textarea></div>
                      <div class="s-12 m-12 l-4"><button class="color-btn" type="submit">Enviar Mensaje</button></div>
                    </form>
                  </div>                
               </div>
            </div>
         </div>
         <!-- MAP -->
         <div id="map-block"> 
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15813.428679077002!2d-72.232246!3d7.751889!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x177c372024b7363b!2sGrupo+La+Italiana+Construye!5e0!3m2!1ses-419!2sve!4v1492545293889" width="100%" height="450" frameborder="0" style="border:0"></iframe> 
         </div>
      </section>
      <!-- FOOTER -->
      <footer>
         <div class="line">
            <div class="s-12 l-6">
               <p style="color: white">Copyright &copy; {{ date('Y') }}, La Italiana Construye C.A</p>
            </div>
            <div class="s-12 l-6">
               <a class="right" style="color: white" href="#" title="Responsee - lightweight responsive framework">Diseñado y Codificado por <br>Ing. Joel Heredia - Jesús Sanchez</a>
            </div>
         </div>
      </footer>
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
      <script type="text/javascript">
         jQuery(document).ready(function($) {
            var theme_slider = $("#owl-demo");
            $("#owl-demo").owlCarousel({
                navigation: false,
                slideSpeed: 300,
                paginationSpeed: 400,
                autoPlay: 6000,
                addClassActive: true,
             // transitionStyle: "fade",
                singleItem: true
            });
            $("#owl-demo2").owlCarousel({
                slideSpeed: 300,
                autoPlay: true,
                navigation: true,
                navigationText: ["&#xf007","&#xf006"],
                pagination: false,
                singleItem: true
            });
        
            // Custom Navigation Events
            $(".next-arrow").click(function() {
                theme_slider.trigger('owl.next');
            })
            $(".prev-arrow").click(function() {
                theme_slider.trigger('owl.prev');
            })     
        }); 
      </script>
   </body>
</html>       

            
        </div>
    </body>
</html>
