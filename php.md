---
title: PHP
---

=====parse cloudant json through template=====
<code php>
<?
$db = "https://.....cloudant.com/....";

//check requested URL for doc_id of 32 chars
preg_match('/^\/(.*)/',$_SERVER["REDIRECT_URL"], $matches, PREG_OFFSET_CAPTURE);
if (count($matches)!=2 || strlen($matches[1][0])!=32) all($db);
else single($db,$matches[1][0]);

function single($db,$id) {
  $status = get_headers("$db/$id")[0];
  if ($status!="HTTP/1.0 200 OK") die ("ERR:db");

  $obj = json_decode(file_get_contents("$db/$id"));

  $template = file_get_contents("single.html");
  $template = str_replace("{db}", $db, $template);
  $template = str_replace("{id}", $id, $template);
  $template = str_replace("{url}", "https://share.doode3d.com/$id", $template);
  $template = str_replace("{image}", "$db/$id/img", $template);
  $template = str_replace("{title}", $obj->name, $template);
  $template = str_replace("{author}", $obj->author, $template);

  echo $template . "
";
}

function all($db) {
  $json = file_get_contents('https://......cloudant.com/......?limit=25&reduce=false&descending=true');
  $obj = json_decode($json);
  foreach  ($obj->rows as $row) {
    $id = $row->id;
    $thumb = $row->value->thumb;
    echo "<a href='https://......./$id'><img src='$thumb'></a>
";
  } 
}

?>
</code>

=====composer=====
https://getcomposer.org/doc/00-intro.md
  curl -sS https://getcomposer.org/installer | php
  php composer.phar install

=====list images in folders as JSON=====
<code php>
<?php
header('Content-type: application/json');
$rootfolder = "photos/*";
$albums = [];

foreach (glob($rootfolder) as $folder) {
  $album = [];
  $album["folder"] = basename($folder);
  $album["title"] = basename($folder);

  $items = [];
  foreach (glob($folder."/*.jpg") as $filename) {
    list($width, $height, $type, $attr) = getimagesize($filename);
    $item = [];
    $item["filename"] = basename($filename);
    $item["src"] = $filename;
    $item["w"] = $width;
    $item["h"] = $height;
    $items[] = $item;
  }
  $album["photos"] = $items;
  $albums[] = $album;
}

echo json_encode($albums);
?>
</code>

=====json header=====
<code php>
header('Content-type: application/json');
</code>

=====array_map & str_getcsv=====
<code php>
//"07","Week 3","54.jpg"
$a = array_map('str_getcsv', file('info.txt'));
</code>

=====glob=====
<code php>
foreach (glob("fotos/$folder/*.jpg") as $filename) {
  list($width, $height, $type, $attr) = getimagesize($filename);
  $items[] = "{ src: '$filename', w:$width, h:$height }";
}
</code>

=====youmagine missing API call: get image preview for document=====
<code php>
header("Access-Control-Allow-Origin: *");
header("Content-type: text/plain");
if (empty($_GET['id'])) die("id is undefined");
if (!is_numeric($_GET['id'])) die("id should be a valid number");
$id = $_GET["id"];

$json = json_decode(file_get_contents("https://www.youmagine.com/documents/$id.json"));
$documentable_id = $json->documentable_id;
$url = getDesignURLById($documentable_id);
$html = file_get_contents($url);

preg_match("/<article data-id=\"".$id."\" .+?id=\"(\d+)\"/", $html, $matches);

echo $matches[1];

function getDesignURLById($designId) {
  $url = "https://www.youmagine.com/designs/$designId";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, TRUE); // We'll parse redirect url from header.
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE); // We want to just get redirect url but not to fo$
  $response = curl_exec($ch);
  preg_match_all('/^Location:(.*)$/mi', $response, $matches);
  curl_close($ch);
  return !empty($matches[1]) ? trim($matches[1][0]) : 'No redirect found';
}
</code>

=====PHP.INI on OpenPanel=====
  /etc/php5/apache2/php.ini

=====Use PHPMailer for sending email with attachment=====
<code php>
require 'PHPMailerAutoload.php';
$bodytext = "Testing...";
$email = new PHPMailer();
$email->From      = 'from@email.com';
$email->FromName  = 'YOU';
$email->Subject   = 'Message Subject';
$email->Body      = $bodytext;
$email->AddAddress('to@email.com');
$file_to_attach = 'test.png';
$email->AddAttachment( $file_to_attach , 'test.png' );
return $email->Send();
</code>

=====Save Base64 encoded raw data from post as image===== 
<code php>
header("Access-Control-Allow-Origin: *");
$img = $GLOBALS["HTTP_RAW_POST_DATA"];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = 'test.png';
$success = file_put_contents($file, $data);
</code>

===== Install GD =====
  apt-get install php5-gd

=====online code testen=====
http://runnable.com/

=====socket server with php=====
http://devzone.zend.com/209/writing-socket-servers-in-php/

=====upload script=====
based on: http://www.w3schools.com/php/php_file_upload.asp
permissions: 755
<code php>
<?php
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br>";

  move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
  echo "Stored in: " . "upload/" . $_FILES["file"]["name"];

  }
?>
</code>

=====Solve the following problem om CentOS=====
'''PHP Warning:  PHP Startup: Unable to load dynamic library '/usr/lib64/php/modules/module.so' - /usr/lib64/php/modules/module.so: cannot open shared object file: No such file or directory in Unknown on line 0'''

edit /etc/php.d/mcrypt.ini and change
<code>
extension=module.so
</code>
to
<code>
extension=mcrypt.so
</code>

=====AMPPS=====
* http://www.ampps.com/

=====last item from array=====
<code php>
$item = end($array);
</code>

=====strip illegal characters from string=====
<code php>
$location = preg_replace('/[^( -)]*/','', $location);
</code>

=====append or create if not exists=====
<code php>
file_put_contents($path, $data, FILE_APPEND);
</code>

=====get random string=====
<code php>
function getRandomKey($count) { 
  $chars = "abcdefghijklmopqrstuvwxyz1234567890";
  for ($a=0; $a<$count; $a++) $str.=$chars[rand(0,strlen($chars)-1)];
  return $str;
}
echo getRandomKey(6);
</code>
or shorter and with no duplicate characters per string:
<code php>
echo substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
</code>
or if you only need a hex string:
<code php>
echo substr(md5(rand()), 0, 6);
</code>

=====get url info ie. in 404.php=====
<code php>
echo $_SERVER["REDIRECT_URL"];
</code>

=====remove links with regexp=====
<code php>
$result = preg_replace('/(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $input);
</code>

=====auto include=====
<code php>
function __autoload($class_name) {
    include $class_name . '.php';
}
</code>

=====extract, stripslashes & sqlite escape=====
<code php>
if (get_magic_quotes_gpc() ) {
  $_GET = array_map('stripslashes', $_GET);
}
$_GET = array_map('sqlite_escape_string', $_GET);
extract($_GET);
</code>

=====json header=====
<code php>header("Content-type: application/json");</code>

=====file_get_contents_utf8=====
<code php>
function file_get_contents_utf8($fn) {
    $content = file_get_contents($fn);
    return mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}
</code>

=====encoding of non utf-8 content to json=====
http://www.php.net/manual/en/function.json-encode.php#99837

=====Convert PHP Object to array=====
<code php>
$eventArray = (array)$event;
</code>

=====Encoding=====
als je last van rare tekens hebt (zoals ë wordt Ã«) dan staat misschien de encoding van je pagina verkeerd.
<code php>
header("Content-Type: text/plain; charset=utf-8"); //iso-8859-1
</code>
Bij het inserten van UTF-8 tekst in een MySQL datebase dien je eerst een utf8_decode te gebruiken zoals het er nu naar uitziet.
<code php>
$event->description = utf8_decode($tweet->text);
</code>

=====Als de tijd niet goed staat in PHP staat misschien je timezone verkeerd=====
<code php>
setlocale(LC_ALL, "nl_NL");
date_default_timezone_set("Europe/Amsterdam");
</code>

=====ssl disabled?=====
if ssl seems to be disabled in php just enable it like this in your php.ini:
<code>
extension=php_openssl.dll
</code>

=====short open tags=====
in php.ini
<code>
short_open_tag = On
</code>
http://www.php.net/manual/en/ini.core.php#ini.short-open-tag

=====connect to mysql through console/command line PHP but without Apache=====
if you get this error:
<code>
PHP Warning:  mysql_connect(): [2002] No such file or directory (trying to connect via unix:///var/mysql/mysql.sock) 
</code>
try to connect to 127.0.0.1 instead of localhost

=====twitter=====
twitter uitlezen met PHP? zie [[Twitter]]

=====php versie opvragen=====
<code bash>
php -v
</code>

=====if else endif=====
<code php>
<?php if( condition ): ?>
...  
<?php else: ?>
...
<?php endif; ?>
</code>

=====PEAR=====
Ik moet me nog steeds eens verdiepen in PEAR: http://pear.php.net/manual/en/package.database.db.intro-fetch.php

=====while / list / each=====

<code php>
while (list($k, $v) = each($_GET)) {
  echo $k . '=' . $v . ', ';
}
</code>

=====mysql transactions in php=====
<code php>
$this->db->startTransaction();
foreach($userIds as $id) {
  $this->db->update("INSERT INTO ......");
}
$this->db->commit();
</code>

=====Internal Server Error 500 door PHP in Apache=====
Als Apache error 500 geeft kan dat liggen aan een fout in de syntax van een PHP script. Door het aanzetten van display_errors in php.ini of door het gebruiken van de ini_set functie in php kun je de exacte foutmelding achterhalen.
<code php>
ini_set('display_errors', 'On');
</code>
Als dat niet helpt kun je ook je php.ini aanpassen. In mijn geval stond die hier (het pad kun je opvragen mbv ''phpinfo()'':
<code>
/Applications/MAMP/bin/php/php5.3.6/conf/php.ini
of hier (op OpenPanel):
/etc/php5/apache2/php.ini
</code>

=====php error log=====
<code>
/Applications/MAMP/logs/php_error.log  
</code>

=====import_request_variables icm sqlite vs extract=====
Problemen met quotes in sqlite zelfs na SQLite3::escapeString of sqlite_escape_string?
* zie post van brian at enchanter in de [[http://php.net/manual/en/function.import-request-variables.php|php reference]]
* maar vooral ook: [[http://www.dirac.org/linux/databases/sql_quoting/|sql quoting]]
<code php>
import_request_variables("g","_"); //kijkt niet naar $_GET dus negeert magic quotes.
</code>
ik gebruik nu ipv daarvan extract (ik weet niet of dat veilig genoeg is maar het werkt wel):
<code php>
if (get_magic_quotes_gpc() ) {
  $_GET = array_map('stripslashes', $_GET);
}
$_GET = array_map('sqlite_escape_string', $_GET);
extract($_GET);
</code>

=====Content-type voor json=====
<code php>
header("Content-type: application/json");
</code>

=====Scraper=====
<code php>
require 'scraperwiki/simple_html_dom.php';

$html_content = scraperwiki::scrape("http://ofxaddons.com/");
$html = str_get_html($html_content);

foreach ($html->find("div.category") as $categories) {
    foreach ($categories->find("div.repo") as $addons) {
        //if ($ttl++>20) exit();

        $link = $addons->find("a.github_link");
        $link = $link[0]->href;
    
        $name = explode("/",$link);
        $name = $name[count($name)-1];
    
        $author = explode("/",$link);
        $author = $author[3];
    
        $category = $categories->find("h2 a");
        $category = $category[0]->plaintext;
    
        //print $category . " - " . $name . " - " . $author . " - " . $link . "
";
    
        $records[] = array("link"=>$link, "name"=>$name, "author"=>$author, "category"=>$category);
    }
}

print "saving...
";
$unique_keys = array("link");
$table_name = "repos";
scraperwiki::save_sqlite($unique_keys, $records, $table_name);
print "done
";
</code>

=====mini api=====
<code php>
<?
header("Content-type: text/plain");

extract($_GET);

if (isset($pinguin)) {
  $html = file_get_contents("http://www.pinguinradio.nl/");
  $parts = explode("Nu op PinguinRadio.nl:</strong> <I>", $html);
  $parts = explode("</I>",$parts[1]);
  $artist = $parts[0];
  $parts = explode("</h2>", substr($parts[1],3));
  $title = $parts[0];
  die("$artist
$title");
}

if (isset($time)) {
  die(date('Y-m-d h:i:s'));
}
</code>