<?php include_once"header.php"; ?>

   <title>图片转base64</title>

</head>

<body>

	<div class="header">

	   <h2>图片上传</h2>

	</div>

	<div class="content text-center">

<form action="upload_file.php" method="post" enctype="multipart/form-data">

    <label for="file">文件名：</label>

    <input type="file" name="file" id="file"><br>

    <input class="button-sub" type="submit" name="submit" value="提交">

</form>

</div>

<div class="footer"></div>

</body>

</html>
