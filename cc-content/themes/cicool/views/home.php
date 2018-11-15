<?= get_header(); ?>
<body id="page-top">
   <?= get_navigation(); ?>


   <section id="services" style="">       
      <div class="container ui-sortable" style=""> 
         <div class="row ui-sortable" style="">     
            <div class="col-lg-12 text-center ui-sortable" style="">       
              <h2 class="section-heading" style="">PORTAL GIS</h2>       
              <h3 class="section-subheading text-muted" style="">Provinsi Sumatera Selatan</h3>    
           </div>     
        </div>       

        <div class="row text-center ui-sortable" style="margin-top:50px">        
           <div class="col-md-8 col-md-offset-2 ui-sortable" style="">         
              <span class="fa-stack fa-4x">         
                 <img src="<?= base_url(); ?>asset/mapgeojson/sumsel.png ?>" class="img-responsive">
              </span>         
              <br>
              <p class="text-muted bg-success" style="margin-top:100px">
               Penggunaan Aplikasi GIS berbasis Web dalam Pemetaan Jalan dan Jembatan di Provinsi Sumatera Selatan
              </p>
              <a href="<?= base_url()?>peta" class="btn btn-primary">LIHAT DEMO</a>  
           </div>           
        </div>       
     </div>     
  </section>
  <?= get_footer(); ?>