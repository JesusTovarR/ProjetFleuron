		<script><!--
function TabClick( nTab ){
	Col = document.getElementsByName("Content");
	for (i = 0; i < document.getElementsByName("Content").length; i++)
    	{
		document.getElementsByName("tabs")[i].className = "TabBorderBottom TabCommon TabOff";
    	document.getElementsByName("Content")[i].style.display = "none";
		}
	document.getElementsByName("Content")[nTab].style.display = "block";	
	document.getElementsByName("tabs")[nTab].className = "TabCommon TabOn TabActiveBackground TabActiveBorderLeftRight";
}
// -->
		</script>
		<style><!--
			.tabactivebackground { background-color: #621d1d }
			.tabcommon { color: white; font: 15px Arial; text-align: center; padding: 10px; height: 30px }
			.tabcontent { padding: 5px }
			.tabcontentbottom { padding: 5px; border-bottom: 2px outset #99ccff }
			.taboff { color: white; background-color: #371111; cursor: : hand }
			.tabon { color: white; cursor:pointer }-->
		</style>