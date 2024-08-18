
<footer>
  <hr>
  <div class="mt-2 text-center ">
    <p class="copyright-text">
      <small class="col-12 mt-auto mb-5 text-muted">Copyright © 2024 - Michi Bataluna | Arvin Guno | Lhil Mendoza (SMCC)</small>
    </p><br>
  </div>
</footer>

<!-- links every page it is called to the scripts -->
<script src="<?= pathname('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= pathname('vendor/jquery/jquery-3.7.1.min.js') ?>"></script>
<script src="<?= pathname('vendor/jquery/jquery.timeago.js') ?>"></script>
<script>
  var URI_PREFIX = "<?= URI_PREFIX ?>";
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