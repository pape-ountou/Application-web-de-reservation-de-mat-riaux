<div class="slide-one-item home-slider owl-carousel">
      <div class="site-blocks-cover overlay" style="background-image: url('/~e21909825/bootstrap/images/hero_bg_2.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-start">
            <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
              <h1 class="bg-text-line">Russia's World Cup Championship</h1>
              <p><a href="#" class="btn btn-primary btn-sm rounded-0 py-3 px-5">Read More</a></p>
            </div>
          </div>
        </div>
      </div>  
      <div class="site-blocks-cover overlay" style="background-image: url('/~e21909825/bootstrap/images/hero_bg_4.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-start">
            <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
              <h1 class="bg-text-line">Russia's World Cup Championship</h1>
              <p><a href="#" class="btn btn-primary btn-sm rounded-0 py-3 px-5">Read More</a></p>
            </div>
          </div>
        </div>
      </div>  
      <div class="site-blocks-cover overlay" style="background-image: url('/~e21909825/bootstrap/images/hero_bg_3.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-start">
            <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
              <h1 class="bg-text-line">Russia's World Cup Championship</h1>
              <p><a href="#" class="btn btn-primary btn-sm rounded-0 py-3 px-5">Read More</a></p>
            </div>
          </div>
        </div>
      </div>  
    </div>

    <div class="site-section pt-0 feature-blocks-1" data-aos="fade" data-aos-delay="100">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="p-3 p-md-5 feature-block-1 mb-5 mb-lg-0 bg" style="background-image: url('/~e21909825/bootstrap/images/img_1.jpg');">
              <div class="text">
                <h2 class="h5 text-white">Russia's World Cup Championship</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos repellat autem illum nostrum sit distinctio!</p>
                <p class="mb-0"><a href="#" class="btn btn-primary btn-sm px-4 py-2 rounded-0">Read More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="p-3 p-md-5 feature-block-1 mb-5 mb-lg-0 bg" style="background-image: url('/~e21909825/bootstrap/images/img_2.jpg');">
              <div class="text">
                <h2 class="h5 text-white">Russia's World Cup Championship</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos repellat autem illum nostrum sit distinctio!</p>
                <p class="mb-0"><a href="#" class="btn btn-primary btn-sm px-4 py-2 rounded-0">Read More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="p-3 p-md-5 feature-block-1 mb-5 mb-lg-0 bg" style="background-image: url('/~e21909825/bootstrap/images/img_3.jpg');">
              <div class="text">
                <h2 class="h5 text-white">Russia's World Cup Championship</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos repellat autem illum nostrum sit distinctio!</p>
                <p class="mb-0"><a href="#" class="btn btn-primary btn-sm px-4 py-2 rounded-0">Read More</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h1><?php echo $titre; ?></h1><br />
<?php
if (!empty($news) && is_array($news)) {
    echo "<table class='table table-hover table-striped table-bordered'>
          <thead class='thead-dark'>
          <tr>
          <th>Titre</th>
          <th>Information</th>
          <th>Auteur</th>
          <th>Date de publication</th>
          </tr>
          </thead>
          <tbody>";
    
    foreach($news as $new) {
        echo "<tr>          
              <td>" .$new['act_titre']."</td>
              <td>" .$new['act_texte']."</td>
              <td>" .$new['cpt_pseudo']."</td>
              <td>" .$new['act_date']."</td>

              </tr>";
    }
    
    echo "</tbody>
          </table>";
} else {
    echo "Pas d'actualité !";
}
?>
