<!-- ========================= MIDDLE END ======================== -->
			</div>
		</div>
		<div id="content_bottom"></div>
		<div id="footer"><a href="http://webdesign.steveblackonline.com">steve black web development &amp; graphic design</a></div>
	</div>

	<script language="javascript">
		arrDivLinks = document.getElementById("tab_nav").getElementsByTagName("div");
		y=arrDivLinks.length - 1;	
		for (x=0;x<arrDivLinks.length;x++)
		{
			if (x==<?php if ($_GET['index']) {echo $_GET['index'];}else{echo "0";} ?>)
			{
				arrDivLinks[x].style.zIndex = arrDivLinks.length;
				arrDivLinks[x].className = "active";
			}
			else
			{
				arrDivLinks[x].style.zIndex = y;
				arrDivLinks[x].className = "";
				y--;
			}
		}
	</script>
</body>
</html>