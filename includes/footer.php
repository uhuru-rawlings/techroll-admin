<footer class="main-footer">
    <strong>Copyright &copy; <span id="years"></span> <a href="techrollblogs.com">Techroll</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

<script>
    var year = new Date();
    var curr = year.getFullYear();
    document.getElementById("years").innerText = curr;
</script>