/*********************************************************************
iciwebface 
Скрипт запроса через прокси данных с icinga2
Павел Сатин <pslater.ru@gmail.com>
19.01.2016
  
**********************************************************************/

$(document).ready(function () {

//Обработка нажатия 
  $('#fab_checkhost').click(function () {
    var showData = $('#show-data');

    var json_url = 'icinga-proxy.php?checkhost=' + checkhost.value;
    console.log(json_url);
    $.getJSON(json_url, function (data) {
      //console.log(data);
      //showData.text(data);    
      var data0 = data.results;
      //console.log(data0);
      showData.text(data0[0].status);

      setTimeout(function () { location.reload(1); }, 5000);

    });

  });



});
