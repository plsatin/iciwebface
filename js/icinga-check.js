/*********************************************************************
iciwebface 
Скрипт запроса через прокси данных с icinga2
Павел Сатин <pslater.ru@gmail.com>
19.01.2016
  
**********************************************************************/

$(document).ready(function () {

//Обработка нажатия 
  $('#fab_checkhost').click(function () {

    var dataJson;
    var snackbarContainer = document.querySelector('#host-snackbar');

    var json_url = 'icinga-proxy.php?checkhost=' + checkhost.value;
    //console.log(json_url);
    $.getJSON(json_url, function (data) {
    
    dataJson = data.results;

///////////////////////////
    //console.log(dataJson);
      'use strict';
    
      var data = {
        message: dataJson[0].status,
        timeout: 10000,
      };
      snackbarContainer.MaterialSnackbar.showSnackbar(data);
//////////////////////////////

      setTimeout(function () { location.reload(1); }, 5000);

    });

  });

});
