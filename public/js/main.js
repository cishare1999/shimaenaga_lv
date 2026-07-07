

 //ふわっと
jQuery(function ($) {
  var fadeIn = $('.fade-in');
  $(window).on('scroll', function () {
    $(fadeIn).each(function () {
      var offset = $(this).offset().top;
      var scroll = $(window).scrollTop(); 
      var windowHeight = $(window).height();
      if (scroll > offset - windowHeight + 150) {
        $(this).addClass("scroll-in");
      }
    });
  });
});


 //■コンテンツ表示アニメーション
document.addEventListener("DOMContentLoaded", function () {
    const animatedElements = document.querySelectorAll(".animate");

    const handleScroll = () => {
        animatedElements.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top <= window.innerHeight - 100 && rect.bottom >= 0) {
                el.classList.add("visible"); // 視認範囲に入ったらvisibleクラスを追加
            } else {
                el.classList.remove("visible"); // 視認範囲から出たらvisibleクラスを削除（必要なら）
            }
        });
    };

    window.addEventListener("scroll", handleScroll);
    handleScroll(); // 初回実行（ロード時の確認）
});

$(function () {
  $('.js-open').click(function () {
    $("body").addClass("no_scroll"); // 背景固定させるクラス付与
    var id = $(this).data('id'); // 何番目のキャプション（モーダルウィンドウ）か認識
    $('#overlay, .modal-window[data-id="modal' + id + '"]').fadeIn();
  });
  // オーバーレイクリックでもモーダルを閉じるように
  $('.js-close , #overlay').click(function () {
    $("body").removeClass("no_scroll"); // 背景固定させるクラス削除
    $('#overlay, .modal-window').fadeOut();
  });
});


//■page topボタン
    $(function(){
    var topBtn=$('#pageTop');
    topBtn.hide();
    //◇ボタンの表示設定
    $(window).scroll(function(){
      if($(this).scrollTop()>120){
        //---- 画面を120pxスクロールしたら、ボタンを表示する
        topBtn.fadeIn();
      }else{
        //---- 画面が80pxより上なら、ボタンを表示しない
        topBtn.fadeOut();
      }
    });

    // ◇ボタンをクリックしたら、スクロールして上に戻る
    topBtn.fastClick(function(){
      $('body,html').animate({
      scrollTop: 0},500);
      return false;
    });
    });
    
    
// 画面遷移時にフワッとフェードアウト・フェードイン
$(window).on('load', function(){
  $('body').removeClass('fade');
});
$(function() {
  // ハッシュリンク(#)と別ウィンドウでページを開く場合はスルー
  $('a:not([href^="#"]):not([target])').on('click', function(e){
    e.preventDefault(); // ナビゲートをキャンセル
    url = $(this).attr('href'); // 遷移先のURLを取得
    if (url !== '') {
      $('body').addClass('fade'); // bodyに class="fadeout"を挿入
      setTimeout(function(){
        window.location = url; // 0.8秒後に取得したURLに遷移
      }, 800);
    }
    return false;
  });
});