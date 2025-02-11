<footer class="footer" id="footer">
    <div class="container">
        <div class="row">
            <!-- Logo dan Informasi -->
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <h1 class="logo-footer">Future <span>sight.</span></h1>
                <p class="subheading-footer">Sukses alumni adalah kebanggan<br>
                    bagi almamater kami</p>
                <div class="sosmed-icon">
                    <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                    <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                </div>
                <p class="copyright">&copy;Copyright {{ date('Y') }} All Right Reserved | Built by Muhammad Hanafi</p>
            </div>

            <!-- Tentang -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4">
                <h3>Tentang</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Visi & Misi</a></li>
                    <li><a href="#">Berita</a></li>
                    <li><a href="#">Program</a></li>
                </ul>
            </div>

            <!-- Institusi -->
            <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-4">
                <h3>Institusi</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Mengapa memilih kami?</a></li>
                    <li><a href="#">Kerjasama</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>

            <!-- Bantuan -->
            <div class="col-6 col-md-6 col-lg-2 mb-4">
                <h3>Bantuan</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Akun</a></li>
                    <li><a href="#">Pusat Bantuan</a></li>
                    <li><a href="#">Saran</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                    <li><a href="#">Aksesibilitas</a></li>
                </ul>
            </div>

            <!-- Form Kontak -->
            <div class="">
                <h3>Hubungi Kami</h3>
                <p>Ada pertanyaan atau masukan?</p>
                <form action="{{ route('contact.store') }}" method="POST" class="form-input">
                    @csrf
                    <div class="input-group flex-column">
                        <input type="text" name="name" class="form-control mb-2 w-100" placeholder="Masukkan nama Anda" required>
                        <div class="d-flex">
                            <input type="email" name="email" class="form-control mb-2 me-2" placeholder="Masukkan email Anda" required>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>