<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 29-5-2017
 * Time: 09:50
 */

?>
<body>
<nav class="nav">
    <div class="nav-left">
        <a class="nav-item is-brand" href="#">
            <span class="title is-3 is-bold"><?php echo $title; ?></span>
        </a>
    </div>

    <div class="nav-center">
        <a class="nav-item" href="#">
            Home
        </a>
        <a class="nav-item" href="#">
            Agenda
        </a>
        <?php if($isloggedin) {?>
            <a class="nav-item" href="#">
                Ask a question
            </a>
        <?php }?>
    </div>

    <label class="nav-toggle" for="nav-toggle-state">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <input type="checkbox" id="nav-toggle-state" />

    <div class="nav-right nav-menu">
        <span class="nav-item is-tab">
            <div class="field">
                                <script>
                      $( function() {
                          var availableTags = [
                              "Rico",
                              "Mark",
                              "Dani",
                              "Justin",
                              "Trein",
                              "Zveau",
                              "Simon"
                          ];
                          $( "#search" ).autocomplete({
                              source: availableTags,
                              messages: {
                                  noResults: '',
                                  results: function() {}
                              }
                          });
                      } );
                </script>
                <input id="search" class="input" type="text" placeholder="Search" onkeydown="if (event.keyCode == 13) { window.alert('search'); }">
            </div>
        </span>
    </div>
</nav>
