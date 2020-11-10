# SoftwareEngineering
소프트웨어 공학 _ 한끼뚝딱 프로젝트

## 애자일 방법론을 통한 소프트웨어 협업 및 개발 실습

* 협업 툴 사용

* ![trello](https://trello.com/b/cbShzGDz/work-plan)

## 소프트웨어 유지, 보수

Sonarqube를 이용하여 분석

* 리팩토링

* Critical and major issue

  전체적으로 HTML 문서에서 문서 정의 태그(DOGTYPE)나 head 또는 title 태그가 누락된 경우가 많았음. 
  
  아무래도 겉으로 보기에는 기능상에 문제가 없어 보이고, 또 html 스크립트 언어 작성에서 관용적인 부분에 익숙하지 않아 생기는 문제같아 보임.
  
  <br>
  <br>
  
  Minor issues의 경우, if-else 조건문에서 단일 statement가 괄호로 둘러싸여 있지 않아 추후 유지보수에서 에러를 동반할 가능성이 큰 경우와 같이
  좋지 않은 프로그래밍 스킬로 인해 생기는 issue들이 주를 이룸.

* Duplication
  
  주로 백엔드 부분에서 객체화가 안되어 있어서 동일 코드 재사용이 많이 이루어짐.
  
  또는 같은 기능을 하지만 로직은 비슷한 메서드들도 존재.

* Reliability
  
  html 문서들이 DOCTYPE, title 태그 누락, 오타로 인해 적용되지 않는 태그들, 그리고 html5에서는 지향되는 태그 사용등 전체적으로 스크립트 언어 작성에서 
  관용적인 형식을 취하지 않아 reliability가 낮게 나옴.

* Cyclomatic complexity

  사용자의 input에 대한 입력 유효성 검증처리를 하는 validation.js 에서 놓게 나옴. 
  
  실제로 if문이 많아서, test에 필요한 case들이 많이 필요했음.
