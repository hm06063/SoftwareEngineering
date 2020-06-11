
<?php
	session_start();
	require_once("../lib/MYDB.php");
	$pdo = db_connect();
    if(!isset($_SESSION["ID"]))
	{
?>
<div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header header--normal">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="##########" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="../index.php">Home</a></li>
                                <li><a href="../board/list.php">전체 레시피</a></li>
                                <li><a href="#####">카테고리</a>
                                <ul class="dropdown">
                                     <li><a href="../board/Rice.php">밥</a></li>
                                        <li><a href="../board/Maindish.php">메인반찬</a></li>
                                         <li><a href="../board/Subdish.php">밑반찬</a></li>
                                        <li><a href="../board/Soup.php">국</a></li>                                       
                                        <li><a href="../board/Noodle.php">면요리</a></li>
                                        <li><a href="../board/Fish.php">해물</a></li>
                                         <li><a href="../board/Snack.php">분식</a></li>                                       
                                        <li><a href="../board/Drink.php">술안주</a></li>
                                        <li><a href="../board/Dessert.php">디저트</a></li>
                                    </ul>
                                </li>
								
                                 <li><a href="../freeboard/review_list.php">자유게시판</a></li>
                                   <li><a href="../join/join_form.php">회원가입</a></li>
                                 <li><a href="../login/login_form.php">로그인</a></li>


                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <?php
	}
	else
	{
     ?>

     <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header header--normal">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="##########" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="../index.php">Home</a></li>
                                <li><a href="../board/list.php">전체 레시피</a></li>
                                <li><a href="#####">카테고리</a>
                                <ul class="dropdown">
                                      <li><a href="../board/Rice.php">밥</a></li>
                                        <li><a href="../board/Maindish.php">메인반찬</a></li>
                                         <li><a href="../board/Subdish.php">밑반찬</a></li>
                                        <li><a href="../board/Soup.php">국</a></li>                                       
                                        <li><a href="../board/Noodle.php">면요리</a></li>
                                        <li><a href="../board/Fish.php">해물</a></li>
                                         <li><a href="../board/Snack.php">분식</a></li>                                       
                                        <li><a href="../board/Drink.php">술안주</a></li>
                                        <li><a href="../board/Dessert.php">디저트</a></li>
                                    </ul>
                                </li>
                                 <li><a href="../freeboard/review_list.php">자유게시판</a></li>
                                 <li><a href="####">마이페이지</a>
								 <ul class="dropdown">
										<li><a href="../board/fav_list.php">즐겨찾기</a></li>
										<li><a href="../board/mylist.php">내가 쓴 레시피</a></li>
										
								 </ul></li>
                              <li><a href="../login/logout.php">로그아웃</a></li>
                               <a class="text-light"><?=$_SESSION["NICKNAME"]?> 님 환영합니다 </a>

                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>

<?php
	}
?>
