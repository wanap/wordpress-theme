<div class="container footer">
	<p>版权所有Copyright &copy;2016网站名称 &nbsp;&nbsp; <a href="#">公司名称</a></p>
	<p>ICP备案号</p>
</div>

<script language="javascript">

function AddFavorite(sURL, sTitle){

	try	{

		window.external.addFavorite(sURL, sTitle);

	}catch (e){

		try	{

			window.sidebar.addPanel(sTitle, sURL, "");

		}catch (e){

			alert("加入收藏失败，请使用Ctrl+D进行添加");

		}

	}

}

</script>

<?php wp_footer();?>

</body>

</html>