
@extends('layouts.headerapp')
@extends('layouts.footerapp')

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
{{--  <%@ include file="/WEB-INF/views/layout/common/link.jsp" %>  --}}
<link rel="stylesheet" href="{{ asset('css/calendar.css') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<title>予定確認</title>
</head>
<body>

    <script>
        //let array_test = {{$schedule_list}};
        // 表示する年月の取得
        let year = {{$period['year']}}; // 2020
        let month = {{$period['month']}} -1; // 7-1

    </script>
    

@section('header')
    @parent
@endsection
<article>
  <input type="hidden" id="list" value='{{$schedule_list}}' style="display:none">
  {{-- {{$db_items}} --}}

  <div class="calendar-container">
    <div class="calendar-container-inner">
      <div class="calendar-title">
        <form action="calendar" method="post" id="left-form">
          @csrf
          <input type="hidden" name="flag" value="0">
          <input type="hidden" name="month_counter" value={{$month_counter-1}}>
          <div class="title-content">
            <img src="{{ asset('img/left_button.png') }}" alt="left"  id="left" class="left triangle-button">
          </div>
        </form>
        <div class="title-content">
            <h2 id="month">
              {{$period['month']}}
            </h2>
        </div>
        <div class="title-content">
            <h3 id="year">
              {{$period['year']}}                
            </h3>
        </div>
        <form action="calendar" method="post" id="right-form">
          @csrf
          <input type="hidden" name="month_counter" value={{$month_counter+1}}>
          <div class="title-content">
            <img src="{{ asset('img/right_button.png') }}" alt="right" id="right" class="right triangle-button">
          </div>
        </form>
        <div class="clear"></div>
      </div>
      <table class="calendar">
        <thead>
          <tr class="youbi">
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div class="kronon-speak-container">
		<div class="kronon-speak">
		  <div class="arrow-container">
			<div class="arrow_box" id="kronon-message"></div>
		  </div>
		  <img src="{{ asset('img/kronon/kronon_prin.png') }}" class="kronon-img">
		</div>
	  </div>
	</div>
  </div>
  <input type="hidden" id="date_servlet"  value='${date}' style="display:none">
</article>
@section('footer')
    @parent   
@endsection
<script src="{{ asset('js/common/common.js') }}"></script>
<script src="{{ asset('js/calendar.js') }}"></script>
<script src="{{ asset('js/calendar_event.js') }}"></script>
</body>
</html>