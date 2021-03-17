window.onload = function(){

  // ツイート詳細ページ表示(ポップアップ画面)
  $('#detailModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
    var whatever = button.data('whatever')
    var resArray = whatever.split(",");

    var modal = $(this)  //モーダルを取得
    modal.find('.pagado').text(resArray[0])
    modal.find('.title').text(resArray[0])
    modal.find('.media-meta').text(resArray[1])
    modal.find('.summary').text(resArray[2])
  });

  // ユーザーアカウント情報編集ページ表示(ポップアップ画面)
  $('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
    var username = button.data('username')
    console.log(username)
    var modal = $(this)  //モーダルを取得
    modal.find('.form-control').val(username)
  });
}
