<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>United International University (UIU) | Top Ranked Private University</title>
        <link rel="stylesheet" type="text/css" href="indexstyle.css" />
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

           <section style="padding-top: 50px;padding-left:200px;padding-right:200px">
             <?php
                require_once "database.php";
                $sql = "SELECT * FROM f_users ORDER BY type = 'Lecturer' ASC";
                $sql_run = mysqli_query($conn,$sql);
              ?>
              <h3 style="text-align: center;padding-bottom:70px"><span class="label label-warning"><strong>All Faculty Members List</strong></span></h3>
              <table class="table">
                <tbody>
                  <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Official Email</th>
                  </tr>
                  <?php
                      $s = 1;
                      foreach ($sql_run as $row) {
                   ?>
                  <tr>
                  <td><?php echo $s; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['type']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  </tr>
                  <?php
                  $s++;
                }
                   ?>
              </table>
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
