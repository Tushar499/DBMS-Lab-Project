<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>United International University (UIU) | Top Ranked Private University</title>
        <link rel='stylesheet' id='bootstrap-css-css'  href='https://www.uiu.ac.bd/wp-content/themes/master-uiu/inc/css/bootstrap.min.css?ver=5.4.12' type='text/css' media='all' />
        <link rel='stylesheet' id='uiu-master-style-css'  href='https://www.uiu.ac.bd/wp-content/themes/master-uiu/inc/css/base.css?ver=5.4.12' type='text/css' media='all' />
        <link rel='stylesheet' id='uiu-master-child-fonts-css'  href='//fonts.googleapis.com/css?family=Roboto%3A400%2C100%2C300%2C500%2C400italic%2C700%2C900%7CRoboto+Slab%3A400%2C100%2C300%2C700' type='text/css' media='all' />
        <link rel='stylesheet' id='uiu-master-child-style-css'  href='https://www.uiu.ac.bd/wp-content/themes/master-child/style.css?ver=5.4.12' type='text/css' media='all' />

    </head>
    <body class="home page-template page-template-page-templates page-template-master-home page-template-page-templatesmaster-home-php page page-id-24 group-blog">
        <div id="page" class="hfeed site clearfix">
              <header id="header" class="navbar">
                 <div class="container header-container">
                    <div class="row header-container-row">
                      <div class="navbar-header col-xs-12 col-sm-6">
                          <div id="site-logo">
                              <h1 class="sr-only">United International University (UIU)</h1>
                                <a class="navbar-brand " href="index.php"><img src="http://uiu.ac.bd/wp-content/uploads/2015/12/header-logo.png" alt="United International University (UIU)"/></a>
                            </div>
                          </div>
                          <div class="navbar-header-ext col-xs-6">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-primary-collapse">
                                <span class="sr">Menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                      </div>
                    </div>
                 </div>
            </header>
            <nav id="parimary-navbar" class="navbar"  role="navigation">
                <div class="container parimary-navbar-conatiner">
                    <div class="collapse navbar-collapse navbar-primary-collapse">
                       <ul id="menu-primary" class="nav navbar-nav">
                         <li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-18 active"><a title="Home" href="index.php">HOME</a></li>
                         <li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-18 active"><a title="Faculty Members" href="facultymembers.php">FACULTY MEMBERS</a></li>
                         <li id="menu-item-18" class="menu-item-1083" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1083 dropdown"><a title="Log In" href="#">LOGIN</a>
                           <ul role="menu" class=" dropdown-menu">
                             <li id="menu-item-3348" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3348"><a title="Admin" href="a_login.php">ADMIN</a></li>
                             <li id="menu-item-6644" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6644"><a title="Faculty" href="f_login.php">FACULTY</a></li>
                             <li id="menu-item-231" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-231"><a title="Student" href="s_login.php">STUDENT</a></li>
                           </ul>
                         </li>
                         <li id="menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-18 active"><a title="Sign Up" href="#">SIGN UP</a>
                           <ul role="menu" class=" dropdown-menu">
                             <li id="menu-item-6644" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6644"><a title="Faculty" href="f_signup.php">FACULTY</a></li>
                             <li id="menu-item-231" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-231"><a title="Student" href="s_signup.php">STUDENT</a></li>
                           </ul>
                         </li>
                       </ul>
                     </div>
                 </div>
             </nav>
           </div>

           <section style="padding-top: 50px;">
             <div class="slideshow-container">

                <div class="mySlides fade">
                  <div class="numbertext">1 / 3</div>
                  <img src="upload/marsrover.jpg" style="width:100%">
                  <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                  <div class="numbertext">2 / 3</div>
                  <img src="upload/promo.jpg" style="width:100%">
                  <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                  <div class="numbertext">3 / 3</div>
                  <img src="upload/panda.jpg" style="width:100%">
                  <div class="text">Caption Three</div>
                </div>

              </div>
                <br>

                <div style="text-align:center">
                  <span class="dot"></span>
                  <span class="dot"></span>
                  <span class="dot"></span>
                </div>

                <script>
                  let slideIndex = 0;
                  showSlides();

                  function showSlides() {
                    let i;
                    let slides = document.getElementsByClassName("mySlides");
                    let dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                      slides[i].style.display = "none";
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}
                    for (i = 0; i < dots.length; i++) {
                      dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 3000); // Change image every 2 seconds
                  }
                  </script>
                  <style>

                        .mySlides {display: none;}
                        img {vertical-align: middle;}

                        /* Slideshow container */
                        .slideshow-container {
                          max-width: 1000px;
                          position: relative;
                          margin: auto;
                        }

                        /* Caption text */
                        .text {
                          color: #f2f2f2;
                          font-size: 15px;
                          padding: 8px 12px;
                          position: absolute;
                          bottom: 8px;
                          width: 100%;
                          text-align: center;
                        }

                        /* Number text (1/3 etc) */
                        .numbertext {
                          color: #f2f2f2;
                          font-size: 12px;
                          padding: 8px 12px;
                          position: absolute;
                          top: 0;
                        }

                        /* The dots/bullets/indicators */
                        .dot {
                          height: 15px;
                          width: 15px;
                          margin: 0 2px;
                          background-color: #bbb;
                          border-radius: 50%;
                          display: inline-block;
                          transition: background-color 0.6s ease;
                        }

                        .active {
                          background-color: #717171;
                        }

                        /* Fading animation */
                        .fade {
                          animation-name: fade;
                          animation-duration: 1.5s;
                        }

                        @keyframes fade {
                          from {opacity: .4}
                          to {opacity: 1}
                        }

                        /* On smaller screens, decrease text size */
                        @media only screen and (max-width: 300px) {
                          .text {font-size: 11px}
                        }
                  </style>
           </section>
      <section id="top-news" class="topnews">
        <div class="container slider-conatiner">
            <div class="col-xs-12 col-sm-4 col-md-2">
                <div class="news-title">
                    <div class="news-title-gap">
                        <span class="news-title-regular">Job List</span>
                        <span class="news-title-regular">at</span><br>
                        <span class="news-title-bold">UIU</span>
                    </div>
                </div>
            </div>
            <!--Faculty | Lab Assistant | Accountant | Receptionost | Admission Office Staff | Librarian | CP Coach -->
            <div class="col-xs-12 col-sm-8 col-md-10">
              <div id="topnews-slide-carousel" class="owl-carousel topnews-slider">
                <div class="owl-item slide-item slide-item-notice news-slider">
                  <a href="#" title="Top news" class="topnews-link news-slider-text">Faculty</a>
                  <span class="sr topnews-pdate news-slider-date">Lecturers are subject experts who design, develop, and deliver material using a range of methods and platforms.
                    They create course material, lesson plans, and curricula, conduct research and fieldwork, engage with students,
                    assist with processing applications, and also attend interviews, conferences, and meetings.
                  </span>
                </div>
                <!--Undergrade Teaching Assiostant | Grader | Part Time Job at Canteen-->

              <div class="owl-item slide-item slide-item-notice news-slider">
                  <a href="#" title="Top news" class="topnews-link news-slider-text">Lab Assistant</a>
                  <span class="sr topnews-pdate news-slider-date">Lab Assistant is a job where Job responsibility is to serve the Faculty in lab and fix all issues in lab.
                    like Air Condition Temperatuere handeling, Fix PC Problems and other stuffs.
                  </span>
              </div>
              <div class="owl-item slide-item slide-item-notice news-slider">
                  <a href="#" title="Top news" class="topnews-link news-slider-text">Accountant</a>
                  <span class="sr topnews-pdate news-slider-date">An Accountant helps businesses make critical financial decisions
                     by collecting, tracking, and correcting the company's finances. They are responsible for financial audits,
                     reconciling bank statements, and ensuring financial records are accurate throughout the year.
                  </span>
              </div>
              <div class="owl-item slide-item slide-item-notice news-slider">
                  <a href="#" title="Top news" class="topnews-link news-slider-text">Receptionost</a>
                  <span class="sr topnews-pdate news-slider-date">A Receptionist's duties and responsibilities include greeting visitors, helping them navigate through an office,
                     and supplying them with refreshments as they wait. In addition, they maintain calendars for appointments,
                     sort mail, make copies, and plan travel arrangements.
                  </span>
              </div>
              <div class="owl-item slide-item slide-item-notice news-slider">
                  <a href="#" title="Top news" class="topnews-link news-slider-text">Admission Office Staff</a>
                  <span class="sr topnews-pdate news-slider-date">Accepting and filtering student applications. Assessing applications according to our eligibility criteria. Organizing and filing of recruitment documentation.
                     Providing consultations with prospective students when requested.
                  </span>
              </div>
              <div class="owl-item slide-item slide-item-notice news-slider">
                  <a href="#" title="Top news" class="topnews-link news-slider-text">Librarian</a>
                  <span class="sr topnews-pdate news-slider-date">A librarian is in charge of collecting, organizing, and issuing library resources such as books, films, and audio files.
                    They work in a range of settings including public libraries, schools, and museums.
                    Their duties include issuing resources, cataloging books, and conducting regular audits.
                  </span>
              </div>
              <div class="owl-item slide-item slide-item-notice news-slider">
                  <a href="#" title="Top news" class="topnews-link news-slider-text">Undergrade Teaching Assistant</a>
                  <span class="sr topnews-pdate news-slider-date">Assisting the course instructor with class preparation and course materials (e.g., setting up AV equipment or lab specimens, maintaining course website, photocopying)
                    Assisting students in help rooms or review sessions outside of class time. Leading discussion sections or labs.
                  </span>
              </div>
              <div class="owl-item slide-item slide-item-notice news-slider">
                  <a href="#" title="Top news" class="topnews-link news-slider-text">Grader</a>
                  <span class="sr topnews-pdate news-slider-date">Assisting the course instructor with class preparation and course materials
                    evaluate the exam scripts of the students and update the Marks and the Grade.
                  </span>
              </div>
              <!--Shuttle Driver | Cleanner | Gardener | Gate Man | Electrician | Indor Game Mentor -->
        </div>
     </section>


     <section id="muster-home-widgets" class="home-widgets">
       <h2 style="text-align:center">Top Faculties</h2>
       <div style="padding-Top: 50px"class="container container-home-widgets">
         <div class="row row-widgets home-widgets-ad" style="margin-bottom:15px">
           <div id="text-10" class="widget widget_text col-xs-12 col-sm-12 col-md-12">
             <div class="textwidget"></div>
          </div>
         </div>
       <div class="row row-widgets home-widgets-middle home-widget-middle-left">
          <div class="col-xs-12 col-sm-4">
              <div id="featured_content_widget-14" class="widget"><div class="widget-inner "><h3 class="widget-title">Pro Vice Chancellor</h3>
                <figure class="widget-img "><img class="img-responsive" src="https://www.uiu.ac.bd/wp-content/uploads/2022/08/20-11_Kashem-Side-Photo-Mid.jpg" alt="" /></figure>
                <div class="widget-caption"><div class="widget-exp"><p><b>Prof Dr. Md. Abul Kashem Mia<br />
                    Vice Chancellor (In-Charge) & Pro Vice Chancellor<br />
                    Former Professor and Head, CSE Dept., BUET</b></p>
                </div>
              </div>
            </div>
          </div>
       </div>

       <div class="col-xs-12 col-sm-4">
           <div id="featured_content_widget-14" class="widget"><div class="widget-inner "><h3 class="widget-title">Professor & Executive Director</h3>
             <figure class="widget-img "><img style="height:455px;width:330px;"class="img-responsive" src="upload/rezwan.jpg" alt="" /></figure>
             <div class="widget-caption"><div class="widget-exp"><p><b>Dr. M. Rezwan Khan<br />
                  Ph.D. Professor, EEE & Executive Director, IAR, Distinguished Lecturer, IEEE-IAS<br /></p>
             </div>
           </div>
         </div>
       </div>
    </div>

      <div class="col-xs-12 col-sm-4">
          <div id="featured_content_widget-14" class="widget"><div class="widget-inner "><h3 class="widget-title">Professor</h3>
            <figure class="widget-img "><img style="height:455px;width:330px;"class="img-responsive" src="upload/huda.png" alt="" /></figure>
            <div class="widget-caption"><div class="widget-exp"><p><b>Dr Mohammad Nurul Huda<br />
                Professor, CSE and MSCSE Director, UIU<br />
                Vice President(Academic), BCS; Senior Director( AI & NLP), eGeneration Ltd.</b></p>
            </div>
          </div>
        </div>
      </div>
    </div>

     <div class="col-xs-12 col-sm-4">
         <div id="featured_content_widget-14" class="widget"><div class="widget-inner "><h3 class="widget-title">Professor</h3>
           <figure class="widget-img "><img style="height:455px;width:330px;" class="img-responsive" src="upload/afsal.jpg" alt="" /></figure>
           <div class="widget-caption"><div class="widget-exp"><p><b>Prof. Dr. Afzal Ahmed<br />
               Professor and Head, Dept. of Civil Engineering</b></p>
           </div>
         </div>
       </div>
     </div>
     </div>

     <div class="col-xs-12 col-sm-4">
         <div id="featured_content_widget-14" class="widget"><div class="widget-inner "><h3 class="widget-title">Pro Vice Chancellor</h3>
           <figure class="widget-img "><img style="height:455px;width:330px;" class="img-responsive" src="upload/saim.jpg" alt="" /></figure>
           <div class="widget-caption"><div class="widget-exp"><p><b>Dr. Salekul Islam<br />
               Head of the Computer Science and Engineering (CSE) Department of.<br />
                United International University (UIU), Bangladesh</b></p>
           </div>
         </div>
       </div>
     </div>
     </div>

      </div>

      </div>
    </section>



    <section style="padding-top:50px">
      <h1 style="text-align:center">Top News</h1>
      <img src="upload/marsrover1.jpg" alt="img" class="im">
      <style>

        .im {
        display: block;
        margin-left: auto;
        margin-right: auto;
        padding-top: 20px;
        width: 50%;
        }
      </style>
      <h3 style="text-align:center">UIU MARSROVER</h3>

      <p style="padding-top:10px; text-align:center;padding-left:200px;padding-right:200px">
        UIU's Mars rover – nicknamed "MAVEN" – ranked 1st among Asian countries and 13th among 36 global finalists at the University Rover Challenge (URC) 2022. The event was organised by the Mars Society, a US-based non-profit organisation that advocates and encourages human and robotic exploration on Mars, and also seeks to establish a permanent human presence on the Red Planet. The three-day world final round of the event took place from June 2-4 at the Mars Desert Research Station (MDRS) in southern Utah.

        Before the final round, the UIU Mars Rover team competed with 98 other universities from all around the world to secure a place in the finals. MAVEN achieved an outstanding score of 90.92 out of 100 to be selected as one of the 36 finalists from 10 countries including the USA, Canada, Australia, India, Poland, Columbia, Egypt, Mexico, and Turkey.In the initial round, the team had to submit a System Acceptance Review (SAR) video to the competition. This video focused on the various capabilities of the rover, and its ability to perform a variety of missions like terrain traversal and delivery, equipment servicing, and autonomous mission. MAVEN also performed a variety of scientific tests where it analysed soil and rock samples to detect the presence of life. The video also went through MAVEN's core electronic and communication systems, as well as its testing and operation capabilities
      </p>

      <img src="upload/debate.jpg" alt="img" class="im">
      <h3 style="text-align:center">UIU DEBATECLUB</h3>

      <p style="padding-top:10px;text-align:center;padding-left:200px;padding-right:200px"> text-align:center">UIU Debate Club became Champion in the 6th Gold Bangladesh National Debate Fest 2022
          United International University Debate Club (UIUDC) became the Unbeaten National Champion in Martyred Dr. Shamsuzzoha Memorial 6th Gold Bangladesh National Debate Fest 2022 by defeating Jahangirnagar University by 9-0 ballots. The Fest was held in Rajshahi University on 2-3 September 2022. A team of three members from UIUDC participated in this fest. They are M M Tasnim, Dept. of Economics, Abdullah Al Habib Badhon, Dept. of CSE and K. M. Ismail Safa, Dept. of Economics. Among them, Abdullah Al Habib Badhon became ‘Debater of the Tournament’ and ‘Debater of the Final’ at a time.
          In this fest, 28 private and public Universities including Dhaka University, Jahangirnagar University, Jagannath University, Rajshahi University, Khulna University, Rajshahi College, East West University, Stamford University, Premier University, CUET, RUET participated in this national debate fest. Professor Golam Shabbir Sattar, honorable Vice-Chancellor of Rajshahi University was the Chief Guest and handed over the Champion trophy to the winners. Professor Md. Sultan-Ul-Islam, Pro Vice-Chancellor of Rajshahi University was the Special Guest. Among others, Prof. Dr. Pradip Kumar Panday, Dept. of Mass Communication and Journalism, Prof. Dr. Md. Rabiul Islam, Dept. of Social Work, University of Rajshahi, Tasmia Haque, President of Gold Bangladesh and other prominent persons were also present there.</p>
      </p>
    </section>




        <section style="padding-top:50px">
            <h1 style="text-align:center">About Us</h1>
            <p style="text-align:center;padding-left:200px;padding-right:200px;padding-top:20px">United International University is a private university approved by the Government of the People’s Republic of Bangladesh and University Grants Commission (UGC).
              United International University is established with the generous support and patronage of the United Group, a very successful conglomerate operating in diverse business areas in Bangladesh.
              <br>
              <u style="text-align:center">Vision:</u> The vision of UIU is to become the center of excellence in teaching, learning and research in the South Asian region.
              <br>
              <u style="text-align:center">Mission:</u> The mission of UIU is to create excellent human resources with intellectual, creative, technical, moral and practical skills to serve community, industry and region. We do it by developing integrated, interactive, involved and caring relationships among teachers, students, guardians and employers.
              <br>
              <br>
              <u style="text-align:center">UIU ranking</u> <br>
              . THE Impact Ranking 2020 & 2021 and 2022 UIU is in 32nd position in the world on SDG 8 (Decent Work and Economic Growth)
              <br>
              . QS Asia University Ranking 2019, 2020, 2021 & 2022, UIU has been ranked among the top 350
              universities in Asia.
            </p>
        </section>





            <footer>
               <div id="footer-area">
                 <section id="footer-widgets" class="clearfix">
                   <div class="container container-footer-widgets">
	                    <div class="footer-widget-area">
				                <div class="footer-widget" role="complementary">
			                    <div id="text-2" class="widget widget_text"><h3 class="widget-title">Quick Contact</h3>
                            <div class="textwidget"><p>United City, Madani Avenue,  Badda, Dhaka 1212, Bangladesh.</p>
                            <p>Phone: <a href="tel:+8809604-848-848">+88 09604-848-848</a></p>
                            <p>info@uiu.ac.bd<br />
                            Admission Office: <a href="tel:+8801759039498">+8801759039498</a>, <a href="tel:+8801759039451">+8801759039451</a>, <a href="tel:+8801759039465">+8801759039465, </a><a href="tel:+8801914001470">+8801914001470</a></p>
                            <p>Office Time: Sat-Wed 8:30 AM to 4:30 PM</p>
                            <p>&nbsp;</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            </footer>
     </body>
</html>
