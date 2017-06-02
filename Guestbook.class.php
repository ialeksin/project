<?php
class Guestbook{
   var $messageDir = 'messages';
   var $dateFormat = 'Y-m-d g:i:s A';
   var $itemsPerPage = 5;
   var $messageList;
   
function processGuestbook(){
   if (isset($_POST['submit'])) {
      $this->insertMessage();
   }
   $page = isset($_GET['page']) ? $_GET['page'] : 1;
   
   $this->displayGuestbook($page);
}
   
function getMessageList(){
	
   $this->messageList = array();
   
	if ($handle = @opendir($this->messageDir)) {
		while ($file = readdir($handle))  {
		    if (!is_dir($file)) {
		       $this->messageList[] = $file;
      	}
		}
	}	
	
	rsort($this->messageList);
	
	return $this->messageList;
}   

function displayGuestbook($page=1){
      $list = $this->getMessageList();
      echo "<table class='newsList'>";
      
      $startItem = ($page-1)*$this->itemsPerPage;
      if (($startItem + $this->itemsPerPage) > sizeof($list)) $endItem = sizeof($list);
      else $endItem = $startItem + $this->itemsPerPage; 
      
      for ($i=$startItem;$i<$endItem;$i++){
         $value = $list[$i];
      	$data = file($this->messageDir.DIRECTORY_SEPARATOR.$value);
      	$name  = trim($data[0]);
      	$email = trim($data[1]);
         $submitDate = trim($data[2]);	
         unset ($data['0']);
         unset ($data['1']);
         unset ($data['2']);
      	
         $content = "";
         foreach ($data as $value) {
    	       $content .= $value;
         }
      	
      	echo "<tr><th align='left'><a href=\"mailto:$email\">$name</a></th>
      	          <th class='right'>$submitDate</th></tr>";
      	echo "<tr><td colspan='2'>".nl2br(htmlspecialchars($content))."<br/></td></tr>";
      }
      echo "</table>";
      if (sizeof($list) == 0){
         echo "<center><p>No messages at the moment!</p><p>&nbsp;</p></center>";
      }
      if (sizeof($list) > $this->itemsPerPage){
         echo "<div id=\"navigation\">";
         if ($startItem == 0) {
            if ($endItem < sizeof($list)){
               echo "<div id=\"nright\"><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\" >Next &raquo;</a></div>";
            } else {
            }
         } else {
            if ($endItem < sizeof($list)){
               echo "<div id=\"nleft\"><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\" >&laquo; Prev</a></div>";
               echo "<div id=\"nright\"><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\" >Next &raquo;</a></div>";
            } else {
               echo "<div id=\"nleft\"><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\" >&laquo; Prev</a></div>";
            }
         }
         
         echo "<br/></div><br/>";
      }
      echo "<hr />";
      $this->displayAddForm();
}

function displayAddForm(){
?>  
  <form class="iform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Name:<br/>
    <input type="text" name="name" size="30"/><br/><br/>
    Email:<br/>
    <input type="text" name="email" size="30"/><br/><br/>
    Your message:<br/>
    <textarea name="message" rows="7" cols="49"></textarea><br/>
    <center><input type="submit" name="submit" value="Save" /></center>
  </form> 
   
<?php   
}
function insertMessage(){
   $name   = isset($_POST['name']) ? $_POST['name'] : 'Anonymous';
   $email  = isset($_POST['email']) ? $_POST['email'] : '';
   $submitDate  = date($this->dateFormat);
   $content = isset($_POST['message']) ? $_POST['message'] : '';
   
   if (trim($name) == '') $name = 'Anonymous';
   if (strlen($content)<5) {
      exit();
   }
   
   $filename = date('YmdHis');
   if (!file_exists($this->messageDir)){
      mkdir($this->messageDir);
   }
   $f = fopen($this->messageDir.DIRECTORY_SEPARATOR.$filename.".txt","w+");         
   fwrite($f,$name."\n");
   fwrite($f,$email."\n");
   fwrite($f,$submitDate."\n");
   fwrite($f,$content."\n");
   fclose($f);
   
}
}
?>