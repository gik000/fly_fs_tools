<?php
//checking precondition
if( isset($_POST['fileName']) && isset($_POST['fileUrl']) && !empty($_POST['fileName']) && !empty($_POST['fileUrl'])){
  $fileWritten = false;
  //file name given
  $fileName = $_POST['fileName'];
  $fileUrl = $_POST['fileUrl'];
  $file_headers = @get_headers($fileUrl);
  if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
    $message = 'File not found at URL '.$fileUrl;
  } else {
    $time = microtime();
    $outcome = file_put_contents($fileName, fopen($fileUrl, 'r'),LOCK_EX);
    $time = microtime() - $time;
    if($outcome !== 0){
      $message = '<span>File downloaded successfully,<br/>'.$outcome.' bytes correctly written</span>';
      $message .= '<time>in '.$time.' ms.</time>';
      $message .= (chmod($fileName,0755))? '<span>0755 permission successfully assigned</span>' : '<span>Error assigning 0755 permission</span>' ;
      $fileWritten = true;
    } else {
      $message = 'Error writing file';
    }
  }
}
//creating message class
if(isset($fileWritten)){
  if($fileWritten){
    $messageClass = " success";
  } else {
    $messageClass = " danger";
  }
} else {
  $messageClass = " info";
}
?>

<!-- page content -->
<div class="container-fluid">
  <section>
    <form id="serverFileDownloader_form" method="post">
      <ul>
        <li class="fileName">
          <label class="description" for="fileName">File name</label>
          <div>
            <input id="fileName" name="fileName" class="element text medium" type="text" maxlength="255" value=""/>
          </div>
          <p class="guidelines" id="fileName_guide"><small>Rename the file as you wish</small></p>
        </li>
        <li class="fileUrl">
          <label class="description" for="fileUrl">Url</label>
          <div>
            <input id="fileUrl" name="fileUrl" class="element text medium" type="text" maxlength="255" value=""/>
          </div>
          <p class="guidelines" id="fileUrl_guide"><small>Insert the file url you want to download</small></p>
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