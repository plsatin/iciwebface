<?php
/*********************************************************************
iciwebface 
Подвал страницы
Павел Сатин <pslater.ru@gmail.com>
19.01.2016
  
**********************************************************************/
 
require_once( "config.php" );
?>


<div id="host-snackbar" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<!--
        <footer class="mdl-mega-footer" style="padding-bottom: 0px;">
          <div class="mdl-mega-footer--middle-section">

            <div class="mdl-mega-footer--drop-down-section">
              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked="">
              <h1 class="mdl-mega-footer--heading">Навигация</h1>
              <ul class="mdl-mega-footer--link-list">
                <li><a href="index.php">Мониторинг</a></li>
                <li><a href="hreport1.php">Отчет о железе</a></li>
                <li><a href="ticket.php">Открыть тикет</a></li>
              </ul>
            </div>
            <div class="mdl-mega-footer--drop-down-section">
              <input class="mdl-mega-footer--heading-checkbox" type="checkbox" checked="">
              <h1 class="mdl-mega-footer--heading">More information</h1>
              <ul class="mdl-mega-footer--link-list">
                <li><a href="#">Help</a></li>
                <li><a href="#">Privacy and Terms</a></li>
                <li><a href="#">User Agreement</a></li>
              </ul>
            </div>
            <div class="mdl-mega-footer--right-section">
              <br /><br /><br />
              <img src='<?php echo WWW_HOST_PATH ?>/img/logo_icinga-inv.png' style='height: 48px' />
            </div>

          </div>

        </footer>
-->
        <footer class="demo-footer mdl-mini-footer">
          <div class="mdl-mini-footer--left-section">
            <ul class="mdl-mini-footer--link-list">
              <li><a href="#">Help</a></li>
              <li><a href="#">Privacy and Terms</a></li>
              <li><a href="#">User Agreement</a></li>
            </ul>
          </div>
          <div class="mdl-mini-footer--right-section">
              <img src='<?php echo WWW_HOST_PATH ?>/img/logo_icinga-inv.png' style='height: 48px' />
          </div>

        </footer>


  </main>
</div>

    </body>
</html>
