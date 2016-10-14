/*********************************************************************
iciwebface 
Скрипт запроса отправки оповещения об открытом тикете в icinga2
Павел Сатин <pslater.ru@gmail.com>
12.10.2016
  
**********************************************************************/

$(document).ready(function () {

//Обработка нажатия 
  $('#open_ticket').click(function () {
    //var showData = $('#show-data');
    var dataJson;
    var snackbarContainer = document.querySelector('#host-snackbar');

    var json_url = 'icinga-proxy.php?supporthost='+ host.value + '&exitstatus=' + exitstatus.value + '&message=' + message.value;
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


    });

  });

});
