
@extends('layouts.templateapp')

@section('title','予定登録')
@section('link')
    @parent
	<link rel="stylesheet" href="{{ asset('css/schedule_new.css') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('header')
    @parent
@endsection

@section('body')
<article>
  <form action="schedule_create" method="post" class="schedule-new-form" name="form">
  @csrf
	<div class="schedule-regist-area">
	  <div class="loose-leaf"><img src="{{ asset('img/loose_leaf.svg') }}" alt="loose-leaf" id="loose-leaf"></div>
	  <div class="schedule-regist-area-inner">
	      <div class="schedule-regist-font-lev0">予定登録</div>
		    <div class="schedule-regist-border"></div>
	      <div class="schedule-regist-area-1">
	        <div class="schedule-regist-area-1-block">
		        <div class="schedule-regist-font-lev1">日付<span>*</span></div>
		        <div class="schedule-regist-date-area">
              <input name="scheduleDate" id="date" value="{{$scheduleDate ?? '' ?? ''}}" type="date"/></div>
		      </div>
		        <div class="schedule-regist-area-1-block">
		          <div class="schedule-regist-font-lev1">開始時刻<span>*</span></div>
			        <div class="schedule-regist-time">
			          <select name="startTimeHour" id="starthour">
                	<option value="8">8</option>
			          <option value="9">9</option>
			          <option value="10">10</option>
			          <option value="11">11</option>
			          <option value="12">12</option>
			          <option value="13">13</option>
			          <option value="14">14</option>
			          <option value="15">15</option>
			          <option value="16">16</option>
			          <option value="17">17</option>
			          <option value="18">18</option>
			          <option value="19">19</option>
			          </select>
			        </div>

			        <div class="schedule-regist-time-text">時</div>
			        <div class="schedule-regist-time">
			          <select name="startTimeMin" id="startminutes">
				        <option value="00">00</option>
				        <option value="15">15</option>
				        <option value="30">30</option>
				        <option value="45">45</option>
			          </select>
			        </div>
			        <div class="schedule-regist-time-text">分</div>
		        </div>
		        <div class="schedule-regist-area-1-block">
		          <div class="schedule-regist-font-lev1">終了時刻<span>*</span></div>
			        <div class="schedule-regist-time">
			          <select name="endTimeHour" id="endhour"  onchange="selectboxChange();">
				        <option value="8">8</option>
				        <option value="9">9</option>
				        <option value="10">10</option>
		     			<option value="11">11</option>
				        <option value="12">12</option>
				        <option value="13">13</option>
				        <option value="14">14</option>
				        <option value="15">15</option>
				        <option value="16">16</option>
				        <option value="17">17</option>
				        <option value="18">18</option>
				        <option value="19">19</option>
				        <option value="20">20</option>
			          </select>
			        </div>

			        <div class="schedule-regist-time-text">時</div>
			        <div class="schedule-regist-time">
			          <select name="endTimeMin" id="endminutes">
				        <option value="00">00</option>
				        <option value="15">15</option>
				        <option value="30">30</option>
				        <option value="45">45</option>
			          </select>
			        </div>
			        <div class="schedule-regist-time-text">分</div>
		        </div>
	        </div>

	        <div class="schedule-regist-area-2">
		        <div class="schedule-regist-font-lev1">場所<span>*</span></div>
		        <div class="schedule-regist-place">
		        	<select name="place" id="new-place">
			    		<option value="0">オフィス</option>
		        		<option value="1">在宅</option>
		        		<option value="2">外出</option>
		        	</select>
	        	</div>
		    </div>

		    <div class="schedule-regist-area-3">
		        <div class="schedule-regist-font-lev1">タイトル<span>*</span></div>
		        <div class="schedule-regist-title">
		        	<textarea name="title" id="title" rows="1" cols="40" maxlength="100" placeholder="予定のタイトルを100字以内で入力してください" value="{{$title ?? ''}}"></textarea>
		        </div>
		    </div>

		    <div class="schedule-regist-area-4">
		        <div class="schedule-regist-font-lev1">内容</div>
		        <div class="schedule-regist-content">
			        <textarea name="content" id="content" rows="13" cols="40" maxlength="1440" placeholder="予定の内容を1440字以内で入力してください" value="{{$content ?? ''}}"></textarea>
		        </div>
		    </div>
	    </div>

	      <div class=schedule-regist-button>
	        <!--登録ボタン---->
	        <div class=schedule-regist-button-left>
	          <div class="ok-button large-popup-button" id="ok-button" >登録</div>
	        </div>

  	    	<!--キャンセルボタン----->
	        <div class=schedule-regist-button-right>
	          <div class="ok-button large-popup-button cancel-button" id="cancel-button" >キャンセル</div>
  	      </div>
	      </div>
        <div class="clear"></div>
      </div>

      <div class="kronon-banzai"><img alt="banzai" src="{{ asset('img/kronon/kronon_banzai.png') }}"></div>

      <!--エラーまたは完了ポップアップ------------------------------------------------------------------->
      <div class="popup-wrapper error-popup">
        <div class="pop-container">
          <div class="close-popup"> <img src="{{ asset('img/close_button_orange.png') }}" alt="閉じる" class="back-button"> </div>
          <div class="pop-container-inner">
            <div class="message-container">
              <p class=new-msg></p>
            </div>
            <div class="ok-button close-popup">OK</div>
            <img src="{{ asset('img/kronon/kronon_question.png') }}" class="pop-img kronon-question">
          </div>
        </div>
      </div>
      <!--エラーまたは完了ポップアップここまで-------------------------------------------------------------->
  

      <!--本当に戻りますかポップアップ------------------------------------------------------------------->
      <div class="popup-wrapper cancel-popup">
        <div class="pop-container">
	        <div class="close-popup"><img src="{{ asset('img/close_button_orange.png') }}" alt="閉じる" class="back-button"> </div>
	        <div class="pop-container-inner">
		        <div class="message-container">
	            <p>内容は保存されないよ！</p>
		          <h2 class="message-title">本当に戻る？</h2>
		        </div>
		        <a href="calendar"><div class="ok-button">OK</div></a>
		        <div class="ng-button close-popup">キャンセル</div>
		        <img src="{{ asset('img/star/star_angry.png') }}" class="pop-img-top star-angry">
          </div>
	      </div>
      </div>
      <!--本当に戻りますかポップアップここまで------------------------------------------------------------------->

      <!--内容確認ポップアップ----------------------------------------------------------------->
      <div class="popup-wrapper confirm-popup2" id="confirm-popup2">
        <div class="pop-container pop-container-large">
	        <div class="close-popup"> <img src="{{ asset('img/close_button_orange.png') }}" alt="閉じる" class="back-button"> </div>
	        <div class="pop-container-inner">
	          <div class="message-container-large">
		          <h2 class="message-title">この内容で登録するよ！</h2>
		          <table class="popup-table">
		            <tr>
			            <th class="th">名前：</th>
			            <td>{{ Auth::user()->name }}</td>
			          </tr>
			          <tr>
			            <th>予定日時：</th>
			            <td id="time-msg"></td>
			          </tr>
			          <tr>
		              <th>タイトル：</th>
			            <td id="title-msg" class="new-line"></td>
			          </tr>
			          <tr>
			            <th class="last-table">内容：</th>
			            <td class="last-table new-line" id="content-msg"></td>
		            </tr>
		          </table>
		        </div>
	          <div class="ok-button"  id="confirm-ok" >OK</div>
	          <div class="ng-button close-popup">キャンセル</div>
	          <img src="{{ asset('img/star/star_nomal.png') }}" class="pop-large-img-top star-nomal">
	        </div>
	      </div>
      </div>
      <!--内容確認ポップアップここまで----------------------------------------------------------------->
  </form>

  <!--登録完了ポップアップ------------------------------------------------------------------->
  <div class="popup-wrapper complete-popup">
    <div class="pop-container">
	    <div class="close-popup"><img src="{{ asset('img/close_button_orange.png') }}" alt="閉じる" class="back-button"></div>
	    <div class="pop-container-inner">
	      <div class="message-container"><p class=create-msg></p></div>
		    <div class="ok-button next-popup">OK</div>
		    <img src="{{ asset('img/kronon/kronon_star.png') }}" class="pop-img kronon-star">
	    </div>
	  </div>
  </div>
  <!--登録完了ポップアップここまで-------------------------------------------------------------->
</article>
    
@endsection


@section('footer')
    @parent   
@endsection

@section('js_link')
	@parent
	<script src="{{ asset('js/schedule_new_ajax.js') }}"></script>
    <script src="{{ asset('js/schedule_new.js') }}"></script>
@endsection