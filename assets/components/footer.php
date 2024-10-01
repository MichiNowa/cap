
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

<script>
  var URI_PREFIX = "<?= URI_PREFIX ?>";
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