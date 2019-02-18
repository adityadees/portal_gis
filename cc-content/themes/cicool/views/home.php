<?= get_header(); ?>
<body id="page-top"">
   <?= get_navigation(); ?>
<style>
.bg { 
    /* The image used */
    background-image: url("<?= base_url();?>asset/mapgeojson/cover-2.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
}

@media only screen and (max-width: 768px) {
.bg { 
    /* The image used */
    background-image: url("<?= base_url();?>asset/mapgeojson/cover-2.jpg");

    /* Full height */
    height: 100%; 
    margin-top:20px;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
}
.tex{
margin-top:10px;
}
}

@media only screen and (min-width: 768px) {
.tex{
margin-top:100px;
}


@media only screen and (min-width: 992px) {
.tex{
margin-top:200px;
}


@media only screen and (min-width: 1200px) {
.tex{
margin-top:300px;
}
}


</style>

<section id="services" class="bg">   
	   <div class="row justify-content-center">
            <div class="col-md-12 text-center">
               <a href="<?= base_url()?>peta" class="btn btn-primary tex">LIHAT PETA</a>  
            </div>
        </div>
</section>


 

  <?= get_footer(); ?>