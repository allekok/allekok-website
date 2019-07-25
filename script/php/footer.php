<footer id="footer">
    <?php
    include('footer-links.php');
    ?><a href="#" title="چوونە سەرەوە"
      ><i class="material-icons"
       >arrow_upward</i></a>
</footer>
<script>
 /* Users can evaluate their own code. */
 const userCodes = localStorage.getItem('user-codes') || false;
 try
 {
     eval(userCodes);
 }
 catch(e)
 {
     console.warn('"user-codes" Can not be evaluated.');
 }
</script>
<script defer src='/script/js/main.js?v30'></script>
</body>
</html>
