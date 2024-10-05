
<footer>
  <hr>
  <div class="mt-2 text-center ">
    <p class="copyright-text">
      <small class="col-12 mt-auto mb-5 text-muted">Copyright © 2024 - Michi Bataluna | Arvin Guno | Lhil Mendoza (SMCC)</small>
    </p><br>
  </div>
</footer>

<?php
if (!isset($_SESSION['backed'])) {
?>
</div>
<?php } ?>
<!-- links every page it is called to the scripts -->

<!-- JQuery -->
<script src="<?= pathname('vendor/jquery/jquery-3.7.1.min.js') ?>"></script>
<!-- Bootstrap JS -->
<script src="<?= pathname('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<script>
  window.URI_PREFIX = "<?= URI_PREFIX ?>";
  window.PAGE_DATA = {};
  function pathname(path) {
    return new URL(URI_PREFIX + path, window.location.origin).toString();
  }
  window.pathname = pathname;
  <?php
    if (isset($_SESSION['backed'])) {
      unset($_SESSION['backed']);
    } else {
  ?>
  $(window).on('load', function() {
    $("#loading-spinner").fadeOut(500);
    $("#content-body").fadeIn(500);
  });
  <?php } ?>
  function fetchPageData() {
    $.get(pathname("/api/get/pagedata"))
      .done(function ({ data }) {
        if (data) {
          PAGE_DATA = JSON.parse(data);
        }
      })
      .fail(function (jqXHR, textStatus) {
        console.error("Request failed: " + textStatus);
      });
  }
  fetchPageData();
</script>

<?php if (isset($scripts)) {
  foreach ($scripts as $script) {
    // get the file extension from filename $script
    $s = explode("/", $script);
    $filename = array_pop($s);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  ?>
      <script src="<?= $script ?>" type="<?php echo $ext == "mjs" ? "module" : "application/javascript"; ?>"></script>
  <?php }
}

?>
</body>

</html>