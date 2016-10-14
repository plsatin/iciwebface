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


        <footer class="icinga2app-footer mdl-mini-footer">
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
