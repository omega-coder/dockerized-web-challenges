<?php
function get_source_code($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_NOPROGRESS, false);
    curl_setopt($ch, CURLOPT_BUFFERSIZE, 256);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_PROTOCOLS,  CURLPROTO_HTTP);
    curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function ($ch, $download_size = 0, $downloaded = 0, $upload_size = 0, $uploaded = 0) {
         return ($downloaded > (100 * 1024)) ? 1 : 0;
    });
    $source_code = curl_exec($ch);
    $curl_errno = curl_errno($ch);
    curl_close($ch);
    if ($curl_errno > 0) {
        throw new Exception();
    }
    return $source_code;
}

function startswith($haystack, $needle)
{
    return substr($haystack, 0, strlen($needle)) === $needle;
}

function is_url_acceptable($url)
{
    return startswith($url, 'http://') && strpos($url, '127.0.0.1') === false;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Shellmates Code Leaker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

  </head>
  <body>
    <div class="content">
      <h1>Shellmates Code Leaker</h1>
      <div>
          This small app allows you to display the source code of a page web. Make good use of it.
      </div>
      <form class="pure-form" method="POST" action="index.php">
          <fieldset>
            <input type="url" placeholder="http://..." name="url" class="pure-input-1" required pattern="http://.+">
          </fieldset>
          <button type="submit" class="pure-button pure-button-primary button-large">Get Source!</button>
      </form>
      <?php
      if (isset($_POST['url'])) {
          if (is_url_acceptable($_POST['url'])) {
              try {
                  $source_code = get_source_code($_POST['url']);
                  $source_code_purified = htmlentities($source_code, ENT_QUOTES, 'UTF-8');
                  echo "<pre>$source_code_purified</pre>";
              } catch(Exception $e) {
                  echo '<div class="error">Can not retrieved data, maybe the page is too big (100KiB max)?</div>';
              }
          } else {
              echo '<div class="error">Your URL does not seem valid (only http:// is accepted)</div>';
          }
      }
      ?>
      <pre>
      </pre>
    </div>
  </body>
</html>
