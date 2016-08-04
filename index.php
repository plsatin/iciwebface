<?php include ( "header.php" ) ?>

      <div class="icinga2app-ribbon"></div>
      <main class="icinga2app-main mdl-layout__content">
        <div class="icinga2app-container mdl-grid">
          <div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="icinga2app-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--10-col">

      <div class="mdl-layout__header-row">
        <h3>Мониторинг</h3>     
      </div>
        <div class="mdl-layout__header-row"> 
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="domainFilter" id="get-data">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="search" id="domainFilter" name="domainFilter">
              <label class="mdl-textfield__label" for="domainFilter">Enter your query...</label>
            </div>
          </div>   
       </div>

<br />

          <div class="mdl-cell mdl-cell--12-col">
            <div id="show-data"></div>
          </div>


          </div>
        </div>

<?php include ( "footer.php" ) ?>
