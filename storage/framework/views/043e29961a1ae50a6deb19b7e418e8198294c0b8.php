 <!--  FOOTER  -->
   <footer class="page-footer purple darken-3">
        <div class="container">
            <div class="row">
              <div class="col s12 m4 l4">
                  <div class="col s12 m12 l12 info">
                      <h5>Kreativni Hobi Doo</h5>
                      <p>Prve pruge 37P - Zemun</p>
                  </div>
                  <div class="col s12 m12 l12 phones">
                      <h5>Kontakt tel:</h5>
                      <p><a href="tel:+381113196258">+381 11 319 62 58</a></p>
                      <p><a href="tel:+381612844956">+381 61 28 44 956</a></p>
                  </div>
                  <div class="col s12 m12 l12 time">
                      <h5>Radno vreme:</h5>
                      <p>ponedeljak - petak od 9-20h</p>
                      <p>subota od 10 - 15h</p>
                  </div>
                  <div class="col s12 m12 l12 mail">
                      <h5>Kontakt E-mail:</h5>
                      <p><a href="mailto:office@kreativnihobi.rs">prodaja@kreativnihobi.com</a></p>
                  </div>
              </div>
              <div class="col s12 m4 l4 hide-on-small-only">
                <ul>
                  <li><a class="grey-text text-lighten-3" href="javascript:void(0)">O NAMA</a></li>
                  <li><a class="grey-text text-lighten-3" href="javascript:void(0)">KONTAKT</a></li>
                  <li><a class="grey-text text-lighten-3" href="javascript:void(0)">USLOVI KORIŠĆENJA</a></li>
                  <li><a class="grey-text text-lighten-3" href="javascript:void(0)">POLITIKA PRIVATNOSTI</a></li>
                  <li><a class="grey-text text-lighten-3" href="<?php echo e(route('opšti-uslovi')); ?>">OPŠTI USLOVI SLANJA ROBE</a></li>
                  <li><a class="grey-text text-lighten-3" href="javascript:void(0)">Plaćanje</a></li>
                  <li><a class="grey-text text-lighten-3" href="javascript:void(0)">Isporuka</a></li>
                  <li><a class="grey-text text-lighten-3" href="javascript:void(0)">Zamena</a></li>
                </ul>
              </div>
              <div class="col s12 m4 l4">
                  <div class="col s8 m9 l9">
                      <h5>Plaćanje Karticom</h5>
                      <div class="cards-payment">
                          <img src="<?php echo e(asset('images/cards-payment/visa.png')); ?>" alt="Visa" />
                          <img src="<?php echo e(asset('images/cards-payment/aik.png')); ?>" alt="AIK" />
                      </div>
                      <div class="cards-payment">
                          <img src="<?php echo e(asset('images/cards-payment/master-secure.png')); ?>" alt="Master Card" />
                          <img src="<?php echo e(asset('images/cards-payment/paypal.png')); ?>" alt="Paypal" />
                      </div>
                  </div>
                  <div class="col s3 m3 l3 social-icons">
                      <ul>
                        <li><a href="javascript:void(0)"><img src="<?php echo e(asset('images/social-icons/footer-facebook-logo.png')); ?>" alt="facebook logo" /></a></li>
                        <li><a href="javascript:void(0)"><img src="<?php echo e(asset('images/social-icons/footer-instagram-logo.png')); ?>" alt="instagram logo" /></a></li>
                        <li><a href="javascript:void(0)"><img src="<?php echo e(asset('images/social-icons/footer-twitter-logo.png')); ?>" alt="twitter-logo" /></i></a></li>
                      </ul>
                  </div>
                  <div class="col s12 newsletter hide-on-small-only">
                      <form id="newsletter" name="newsletter" method="POST" action="">
                          <i class="material-icons">email</i>
                          <input type="email" name="newsletter" placeholder="Prijavite se za newsletter" />
                      </form>
                  </div>
              </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container center-align">
            © 2017 Copyright KREATIVNI HOBI. Develope and design Bglighthouse
            </div>
        </div>
    </footer>
