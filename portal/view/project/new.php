<?php
$stylesheets = array('project.css');
$scripts = array('project.js');

include 'view/include/header.php';
?>
<div id="new_project">
<form action="/project/new" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
<input type="text" name="project_name" placeholder="(Project Name)" />
<input type="submit" class="button" value="Create" />
</form>
</div>
<?php 
include 'view/include/footer.php';
?>