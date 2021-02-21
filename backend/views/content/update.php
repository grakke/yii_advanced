<form action="index.php?r=content/update" method="post">

	<!-- 加载编辑器的容器 -->
	<script id="container" name="content" type="text/plain"></script>

	<button class="btn-group-lg btn-primary btn-block">提交</button>
</form>

<!-- 配置文件 -->
<script type="text/javascript" src="ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
	var ue = UE.getEditor('container');
	console.log(ue);
</script>
