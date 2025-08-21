<p style="font-family:arial;color:black;font-size:20px;text-align:center;">为什么不抓个包试试呢</p>
<!-- flag{y0u_4re_mas7er_1n_v1ew_sourc4} -->
</body>
<script>
 document.oncontextmenu=function() {
   alert("右键被禁用");
   return false;
  };
 document.onkeydown = function(e) {
    e = window.event || e;
    var k = e.keyCode;
    //屏蔽ctrl+u，F12键
    if ((e.ctrlKey == true && k == 85) || k == 123) {
      if (k == 85)
        alert("Ctrl+U被禁用!");
      else 
        alert("F12被禁用!");
      e.keyCode = 0;
      e.returnValue = false;
      e.cancelBubble = true;
      return false;
    }
 }
</script>
