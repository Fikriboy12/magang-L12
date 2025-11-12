 <!-- ======= Contact Section ======= -->
 @extends('template.master')
 @section('contents')
<style>
    .container-blog {
      width: 80%;
      margin: auto;
    }
    @media(max-width: 768px) {
      .container-blog {
        width: 80%;
      }
    }
   </style>
   <section id = "tentang" class = "mt-5">
    <div class="container-blog">
      <div id="contact" class="contact-area">
        <div class="contact-inner area-padding">
          <img src="<?= url('assets_admin/img/informasi/'.$data['informasi']->gambar_informasi)?>" class="w-100">
          <h3 class="mt-4"><?= $data['informasi']->judul?></h3>  
          <small><?= $data['informasi']->tgl_informasi?></small>
          <p class = "text-justify"><?= $data['informasi']->deskripsi?></p>
        </div>
      </div>
    </div>
  </section>
@endsection