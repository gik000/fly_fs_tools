<?php
//checking precondition
if( isset($_POST['fileName']) && isset($_POST['filePath']) && !empty($_POST['fileName']) && !empty($_POST['filePath'])){
  $fileExtracted = true;
  $zip = new ZipArchive;
  $fileName = $_POST['fileName'];
  $filePath = $_POST['filePath'];
  if ($zip->open($fileName) === TRUE) {
      $zip->extractTo($filePath);
      $zip->close();
      $message = '<span>File successfully extracted</span>';
      $fileExtracted = true;
  } else {
      $message = '<span>Error writing file</span>';
      $fileExtracted = false;
  }
}
//creating message class
if(isset($fileExtracted)){
  if($fileExtracted){
    $messageClass = " success";
  } else {
    $messageClass = " danger";
  }
} else {
  $messageClass = " info";
}
?>
<!-- page content -->
<div id="page" class="container-fluid">
  <section>
    <form id="serverFileDownloader_form" method="post">
      <ul>
        <li class="fileName">
          <label class="description" for="fileName">File name</label>
          <div>
            <input id="fileName" name="fileName" class="element text medium" type="text" maxlength="255" value="<?php print isset($fileName)?$fileName:'';?>"/>
          </div>
          <p class="guidelines" id="fileName_guide"><small>The file that needs to be extracted</small></p>
        </li>
        <li class="filePath">
          <label class="description" for="filePath">File Path</label>
          <div>
            <input id="filePath" name="filePath" class="element text medium" type="text" maxlength="255" value="<?php print isset($filePath)?$filePath:'';?>"/>
          </div>
          <p class="guidelines" id="filePath_guide"><small>Insert the relative path where to extract your archive (Example: ./destination/dir/)</small></p>
        </li>
        <?php
        if(isset($_GET['debugMode'])):
        ?>
        <li class="debug">
          <label class="description" for="debugMode">Debug Mode</label>
          <div>
            <input id="debugMode" name="debugMode" type="checkbox" value="" /> <span class="guidelines" id="debugMode_guide"><small>Check this box to debug (let it empty if you don't know what to do!)</small></span>
          </div>
        </li>
        <?php
        endif;
        ?>
        <li class="buttons">
          <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
        </li>
      </ul>
    </form>
  </section>
  <footer>
    <div class="message<?php print $messageClass;?>">
      <?php echo isset($message) ? $message : ''; ?>
    </div>
  </footer>
</div>