<?php
include "header.php" 
?>

<main class="page-content pt-4 mt-5" aria-label="Content">

  <!-- <div class="wrapper"> -->
  <div class="container">

     <div class="row">
        <div class="col-12">
          
          <div class="card">

            <div class="card-body">

              <!--Title-->
              <h1 class="card-title">Notes</h1>

                <?
                foreach (glob("pages/*.md") as $p) {
                  $pg = preg_replace("/pages\/(.*).md/",'$1',$p)
                  ?><span class="badge"><a href="<?=$pg?>"><?=$pg?></a></span><?
                }
                ?>

            </div>

          </div>

        </div>
      </div>
  </div>

</main>

<? include "footer.php" ?>
