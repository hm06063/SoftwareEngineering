<?php
    session_start();
?>


<html>
     <head>
                <meta charset="UTF-8">   
               <meta name="description" content="Directing Template">
               <meta name="keywords" content="Directing, unica, creative, html">
               <meta name="viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv="X-UA-Compatible" content="ie=edge">
                           <!--Bootsrap 4 CDN-->
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
                 <link rel="stylesheet" href="../css/bootstrap.css">
                 <link rel="stylesheet" href="../css/join_form.css">

            <!-- Google Font -->
                <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

                <!-- Css Styles -->
                     <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
                    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
                    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
                    <link rel="stylesheet" href="../css/flaticon.css" type="text/css">
                    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
                    <link rel="stylesheet" href="../css/barfiller.css" type="text/css">
                    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
                    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
                    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
                    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
                    <link rel="stylesheet" href="../css/style.css" type="text/css">
     </head>
   
       <body>              
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
             <script type ="text/javascript" src="../js/bootstrap.js"></script>          
              <script src="../js/joinCheck.js"></script>
             <?php include "../lib/top_menu_2.php"; ?>                          
              
             <div class="container">
	<div class="d-flex justify-content-center h-100">
            
		<div class="card">
			<div class="card-header">
				<h3>한끼뚝딱 회원가입</h3>
				
			</div>
			<div class="card-body">
			<form name="member_form" method="post" action="joinAction.php">
                                                <div class="input-group form-group">
                                                  <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                    <input type="text" class="form-control"name="ID" placeholder="아이디" id="tbAd" required>    
                                                     <button class="btn btn-warning" type="submit" onclick="check_ID()">아이디 중복확인</button>                                          
                                                </div>

                                                <div class="input-group form-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                 </div>                                      
                                                    <input type="password" class="form-control" name="PASSWORD" placeholder="비밀번호" id="tbSoyad" required>                                             
                                                </div>

                                                <div class="input-group form-group">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                                 <input type="password" class="form-control" name="PASSWORD_confirm" placeholder="비밀번호확인" id="tbEmail" required>                                                                   
                                             </div>

                                            <div class="input-group form-group">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>						
                                            </div>                               
                                                <input type="text" class="form-control" name="NICKNAME" placeholder="닉네임" id="tbSifre" required>
                                               <button class="btn btn-warning" type="submit"  onclick="check_NICKNAME()">닉네임 중복확인</button>                                       
                                          </div>

                                          <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>						
                                            </div>
                                                <input type="text" class="form-control" name="EMAIL" placeholder="이메일" id="tbTekrarSifre" required>                
                                        </div>                               
                                            <div class="form-group">
                                            <input type="submit" value="회원가입" class="btn float-right login_btn btn-light"  onclick="document.member_form.submit()">
                                            </div>
                   </form>
	</div>
			         
		</div>
             
	</div>
</div>
   
   <!-- Js Plugins -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.nice-select.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/jquery.nicescroll.min.js"></script>
    <script src="../js/jquery.barfiller.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/jquery.slicknav.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/main.js"></script>
                   
            

      </body>   
</html>
     
     