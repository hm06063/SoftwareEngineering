
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<body>
		
		<section class="news-post spad">
			
			
			<div class="container">

				<div class="row">
					<div class="col-lg-12">

						<div class="section-title">
							<h2>추천 레시피</h2>
							<p>
								이런 레시피도 이용해보세요!
							</p>
						</div>
					</div>
				</div>
				

				
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="blog__item"style="cursor:pointer" onclick="window.location.href='<?php echo $itemList[0] -> getLink(); ?>'">
                    	<?php $itemList[0] -> showImage(1); ?>
                        <div class="blog__item__text">                           
                            <h3><?php echo $itemList[0] -> getSubject(); ?></h3>
                            <ul class="blog__item__widget"><?php echo $itemList[0] -> getContent(); ?></ul>
                        </div>
                    </div>
                </div>
                   <div class="col-lg-4 col-md-6">
                    <div class="blog__item"style="cursor:pointer" onclick="window.location.href='<?php echo $itemList[1] -> getLink(); ?>'">
                        <?php $itemList[1] -> showImage(1); ?>
                        <div class="blog__item__text">                           
                            <h3><?php echo $itemList[1] -> getSubject(); ?></h3>
                            <ul class="blog__item__widget"><?php echo $itemList[1] -> getContent(); ?></ul>
                        </div>
                    </div>
                </div>
                   <div class="col-lg-4 col-md-6">
                    <div class="blog__item"style="cursor:pointer" onclick="window.location.href='<?php echo $itemList[2] -> getLink(); ?>'">
                        <?php $itemList[2] -> showImage(1); ?>
                        <div class="blog__item__text">                           
                            <h3><?php echo $itemList[2] -> getSubject(); ?></h3>
                            <ul class="blog__item__widget"><?php echo $itemList[2] -> getContent(); ?></ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog__item"style="cursor:pointer" onclick="window.location.href='<?php echo $itemList[3] -> getLink(); ?>'">
                    	<?php $itemList[3] -> showImage(1); ?>
                        <div class="blog__item__text">                           
                            <h3><?php echo $itemList[3] -> getSubject(); ?></h3>
                            <ul class="blog__item__widget"><?php echo $itemList[3] -> getContent(); ?></ul>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </section>
   </body>
   </html>