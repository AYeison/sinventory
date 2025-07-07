
<section class="hero is-success is-fullheight ">
   
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">
                Success!
                 <div class="container-response"></div>
            </h1>
            <h2 class="subtitle">
              <?php 
              if(isset($_GET['message'])) {
                  echo htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8');
                

              } else {
                  echo "Your action was successful.";
              }
              ?>
            </h2>
            <a href="home" class="button is-primary">Go to Home</a>
        </div>
    </div>
</section>
