<section class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Kontak Kami</a></li>
            </ul>
        </div>
</section>

<section class="contact-page">
    <div class="container">
        <iframe src="https://www.google.com/maps/embed?pb=!4v1574061798753!6m8!1m7!1s3CxSKrjTnlpSADVhsj7Gwg!2m2!1d-5.358901938131868!2d105.2768877321782!3f214.75!4f8.200000000000003!5f0.5970117501821992" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        <div class="row contact-page-mid">
            <div class="col-sm-9">
                <form id="form-contact" action="kontak-kami/send" class="form-contact" method="POST">
                    <h1 class="title">Kirimkan Pesan Anda</h1>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-custom" placeholder="Isi Nama Anda" name="name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control form-control-custom" placeholder="Isi Email Anda" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Nomor Handphone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-custom" placeholder="Isi Nomor Handphone Anda" name="phone" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Subjek</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-custom" placeholder="Isi Subjek Pesan Anda" name="subject" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Pesan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control form-control-custom" rows="5" placeholder="Isi Pesan Anda" name="message" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Captcha</label>
                        <div class="col-sm-9">
                            <img src="<?php echo $captcha['image_src'] ?>" style="width: 30%;" alt="">
                            <input type="text" class="form-control form-control-custom" placeholder="Isi Captcha Diatas" style="width: 30%;" name="captcha" required>
                        </div>
                    </div>
                    <button class="form-contact-btn"><i class="far fa-paper-plane"></i> Kirim</button>
                </form>
                <div id="response"></div>
            </div>
            <div class="col-sm-3">
                <h1 class="title">Hubungi Kami</h1>
                <ul class="contact-info">
                    <li><i class="fas fa-map-marker-alt"></i><?php echo $metadata['address']; ?></li>
                    <li><i class="fas fa-phone"></i> <?php echo $metadata['telp']; ?></li>
                    <li><i class="fas fa-envelope"></i> <?php echo $metadata['email']; ?></li>
                </ul>
                <h1 class="title">Pemasangan Iklan</h1>
                <ul class="list-telp">
                    <li><?php echo trim($contactad1[0]); ?> <a href="tel:<?php echo trim($contactad1[1]); ?>"><?php echo trim($contactad1[1]); ?></a></li>
                    <li><?php echo trim($contactad2[0]); ?> <a href="tel:<?php echo trim($contactad2[1]); ?>"><?php echo trim($contactad2[1]); ?></a></li>
                    <li><?php echo trim($contactad3[0]); ?> <a href="tel:<?php echo trim($contactad3[1]); ?>"><?php echo trim($contactad3[1]); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>