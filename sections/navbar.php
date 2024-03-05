<nav class="navbar navbar-expand-lg custom_nav-container ">
  <a class="navbar-brand" href="./">
    <span>
      <?= $name_website ?>
    </span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class=""></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="d-flex mx-auto flex-column flex-lg-row align-items-end">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="./">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tentang">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="surat">Surat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kontak">Kontak</a>
        </li>
      </ul>
    </div>
    <div class="quote_btn-container">
      <a href="auth/">
        <span>
          Login
        </span>
        <i class="fa fa-user" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</nav>