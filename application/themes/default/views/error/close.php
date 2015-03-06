<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>系统维护中 - BageCMS</title>
<link rel="stylesheet" href="<?php echo $this->_theme->baseUrl?>/css/style.css">
</head>
<body>
<div id="error">
  <h1><?php echo $code; ?></h1>
  <div class="message"><?php echo nl2br(CHtml::encode($message)); ?></div>
</div>
</body>
</html>