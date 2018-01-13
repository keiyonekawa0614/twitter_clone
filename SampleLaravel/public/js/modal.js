window.onload = function(){
  $('#detailModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
    var whatever = button.data('whatever')
    var resArray = whatever.split(",");

    var modal = $(this)  //モーダルを取得
    modal.find('.pagado').text(resArray[0])
    modal.find('.title').text(resArray[0])
    modal.find('.media-meta').text(resArray[1])
    modal.find('.summary').text(resArray[2])
    console.log(resArray[2])
  });
}
