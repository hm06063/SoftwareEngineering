<script type="text/javascript">
    var time = 0;
	var count;
	var count_re;
	var pivot;
	
	function play() { 
		var audio = document.getElementById('audio_play'); 
		if (audio.paused) { 
			audio.play(); 
		}else{ 
			audio.pause(); 
			audio.currentTime = 0 
		} 
	} 

   function timer(num,str){
		pivot=str;
		count=num;
		count_re=count;
		var count_min=parseInt(count_re/60);
		var count_sec=count_re%60;
        clearInterval(time);
        time = setInterval("myTimer()", 1000);

    }

    function myTimer() {
        count_re= count_re - 1;
		count_min=parseInt(count_re/60);
		count_sec=count_re%60;
        document.getElementById(pivot).innerHTML = "<h1><b>" + count_min + "분&nbsp" + count_sec + "초</b></h1>";
        if (count_re == 0) {
            clearInterval(time); // 시간 초기화
            count_re=count;
			count_min=parseInt(count_re/60);
			count_sec=count_re%60;
			play();
        }
    }
	
		
	$('#star_grade a').click(function(){
		$(this).parent().children("a").removeClass("on");  /* 별점의 on 클래스 전부 제거 */ 
		$(this).addClass("on").prevAll("a").addClass("on"); /* 클릭한 별과, 그 앞 까지 별점에 on 클래스 추가 */
		var idx = $(this).index()+1;
		
		$.ajax({
            type: "GET", // POST형식으로 폼 전송
            url: "./star_p.php", // 목적지
            timeout: 10000,
            data: ({'idx':idx, 'id':<?php echo $id?>}),
            cache: false,
            dataType: "json",
        }); 
		
		alert("감사합니다");
		location.href="http://whalsrl5650.cafe24.com/#";
		//history.back();
	});
	
	function favorites(){
		$.ajax({
			url:"./favorites.php",
			type:"GET",
			data:{'id':<?php echo $id?>},
			dataType:"json",
		});
		alert("완료되었습니다");
	}


</script>
