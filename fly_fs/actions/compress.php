<?php
//checking precondition
if( isset($_POST['dirName']) && !empty($_POST['dirName']) ){
  $realPath = $_POST['dirName'];
  $realPath = str_replace('/',DIRECTORY_SEPARATOR,$realPath);
  $realPath = str_replace('\\',DIRECTORY_SEPARATOR,$realPath);
  $realPath = CURRENT_PATH.DIRECTORY_SEPARATOR.$realPath;
  // Get real path for our folder
  $rootPath = realpath($realPath);
  if($rootPath !== FALSE){
    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open('./archive.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($rootPath),
      RecursiveIteratorIterator::LEAVES_ONLY
    );
    foreach ($files as $name => $file) {
      // Skip directories (they would be added automatically)
      if (!$file->isDir())
      {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
      }
    }
    // Zip archive will be created only after closing object
    $zip->close();
  }
}
//creating message class
if($realPath){
  if(file_exists('archive.zip')){
    $messageClass = " success";
    $message = "That's ok!";
    $message .= '<br/>';
    $message .= '<a href="'.CURRENT_URL.'/archive.zip">Here\'s your archive</a>';
  } else {
    $messageClass = " danger";
    $message = "Something went wrong";
    if($rootPath === FALSE){
      $message .= '<br/>';
      $message .= "Directory ".$_POST['dirName']." not found!";
    }
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
        <li class="dirName">
          <label class="description" for="dirName">Directory or file name path</label>
          <div>
            <input id="dirName" name="dirName" class="element text medium" type="text" maxlength="255" value=""/>
          </div>
          <p class="guidelines" id="dirName_guide"><small>Choose a directory or a file to compress (example "./all" or "myfile.ext")</small></p>
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
