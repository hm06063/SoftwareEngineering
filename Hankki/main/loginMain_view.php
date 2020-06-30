    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
       <meta charset="UTF-8">
         <title>한끼뚝딱 - 대한민국 NO.1 요리레시피</title>
        <meta name="description" content="Directing Template">
        <meta name="keywords" content="Directing, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

        <!-- Css Styles -->         
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
	

<body>
<div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
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
                                <li class="active"><a href="./index.php">Home</a></li>
                                <li><a href="./list/All_list_view.php">전체 레시피</a></li>
                                <li><a href="#####">카테고리</a>
                              <ul class="dropdown">
                                        <li><a href="./list/Rice_view.php">밥</a></li>
                                        <li><a href="./list/Maindish_view.php">메인반찬</a></li>
                                         <li><a href="./list/Subdish_view.php">밑반찬</a></li>
                                        <li><a href="./list/Soup_view.php">국</a></li>                                       
                                        <li><a href="./list/Noodle_view.php">면요리</a></li>
                                        <li><a href="./list/Fish_view.php">해물</a></li>
                                         <li><a href="./list/Snack_view.php">분식</a></li>                                       
                                        <li><a href="./list/Drink_view.php">술안주</a></li>
                                        <li><a href="./list/Dessert_view.php">디저트</a></li>
                                    </ul>
                                </li>
                                 <li><a href="./freeboard/review_list.php">자유게시판</a></li>
                                 <li><a href="####">마이페이지</a>
								 <ul class="dropdown">
										<li><a href="../board/fav_list.php">즐겨찾기</a></li>
										<li><a href="../board/mylist.php">내가 쓴 레시피</a></li>
										
								 </ul></li>
                              <li><a href="./login/logout.php">로그아웃</a></li>
                              <li> <a class="text-light">'<?=$_SESSION["NICKNAME"]?>' 님 환영합니다 </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    
    

    <section class="hero set-bg" data-setbg="img/main.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__text">
                        <div class="section-title">
                            <h2>한끼뚝딱</h2>
                            <p>대한민국 NO.1 요리레시피</p>
                        </div>
                        <div class="hero__search__form">
                            <form action="./search/search_data.php" method="post">
                                <input type="text" name="recipe_name" placeholder="Recipe...">
                                <div class="select__option">
                                    <select name="cate">
                                        <option value="">음식 카테고리 전체</option>
										<option value="밥">밥</option>
										<option value="밑반찬">밑반찬</option>
										<option value="메인반찬">메인반찬</option>
										<option value="국">국</option>
										<option value="면요리">면요리</option>
										<option value="해물">해물</option>
										<option value="분식">분식</option>
										<option value="술안주">술안주</option>
										<option value="디저트">디저트</option>
                                    </select>
                                </div>
                                <div class="select__option">
                                    <select name="cost">
                                         <option value="">가격대 전체</option>
					<option value="5000">만원미만</option>
					<option value="15000">만원~2만원</option>	
					<option value="25000">2만원~3만원</option>
					<option value="50000">3만원이상</option>
                                    </select>
                                </div>
                            
                                <button type="submit">검색</button>
                            </form>
                        </div>
                        <ul class="hero__categories__tags">
                            <li><a href="#"><img src="img/hero/cat-6.png" alt="">전체</a></li>
                            <li><a href="#">밑반찬</a></li>
                            <li><a href="./recipe_list/Korean.php">한식</a></li>
                            <li><a href="./recipe_list/Italian.php">양식</a></li>
                            <li><a href="./recipe_list/Chinese.php">중식</a></li>
                            <li><a href="#">국/찌개 </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
       <!-- Js Plugins -->
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.nice-select.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/jquery.nicescroll.min.js"></script>
    <script src="./js/jquery.barfiller.js"></script>
    <script src="./js/jquery.magnific-popup.min.js"></script>
    <script src="./js/jquery.slicknav.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/main.js"></script>
    
</body>
 
