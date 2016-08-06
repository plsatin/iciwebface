/*********************************************************************
iciwebface 
Скрипт запроса через прокси данных с icinga2
Павел Сатин <pslater.ru@gmail.com>
19.01.2016
  
**********************************************************************/

$(document).ready(function () {

//Обработка нажатия поиска    
  $('#get-data').click(function () {
    var showData = $('#show-data');


    var www_path = "";
    var json_url = 'icinga-proxy.php?domain=' + domainFilter.value;

    $.getJSON(json_url, function (data) {
      //console.log(data);
           
      var data0 = data.results;
      
      var items = data0.map(function (item) {
          
        var hostdown = item.attrs.state;
        var icon_image_src = item.attrs.icon_image;
        var hostdown_bage;
        var hostdown_bage_span;

          if (hostdown == 1) {
              
                hostdown_bage = "<span class='mdl-badge mdl-badge--overlap' data-badge='!'>";
                hostdown_bage_span = "</span>";

                icon_image_src = item.attrs.icon_image.slice(0, -4) + "_gray.png";

          } else {
              
              hostdown_bage = "";
              hostdown_bage_span = "";

                if (item.attrs.icon_image) {
                    icon_image_src = item.attrs.icon_image;
 

                } else {
                    icon_image_src = "img/my/dot.png";
                }

          }
          
        return "<td class='mdl-data-table__cell--non-numeric'><img src='" + www_path
         + icon_image_src + "' id='host" + item.attrs.display_name.split('.')[0] + "' />"
         + "<div class='mdl-tooltip' for='host" + item.attrs.display_name.split('.')[0] + "'>" + item.attrs.display_name + "</div>"
         + hostdown_bage_span + "</td><td class='mdl-data-table__cell--non-numeric' onclick='location=\"host.php?host=" + item.attrs.__name + "\"'>"
         + hostdown_bage + hostdown_bage_span + item.attrs.display_name  + "</td>"
         + "<td class='mdl-data-table__cell--non-numeric'>" + item.attrs.vars.domain_name + "</td>"
         //+ "<td class='mdl-data-table__cell--non-numeric'>" + item.attrs.vars.os + "</td>"
         ;
        
      });

      showData.empty();

      if (items.length) {
        var content = '<tr>' + items.join('</tr><tr>') + '</tr>';
        var list = $('<table class="mdl-data-table mdl-js-data-table" style="margin: auto; width: 100%" />').html(content);
        showData.append(list);
      }
    });

    showData.text('Loading the JSON file.');
  });


$('#get-data').click();

setInterval(function(){$('#get-data').click();},60*1000);

});
