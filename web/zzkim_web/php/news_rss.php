<?php
//get the q parameter from URL
$q=$_GET["q"];

//find out which feed was selected
if($q=="agriculture")
  {
  $xml=("http://www.newsfarm.co.kr/rss/S1N1.xml");
  }
  elseif($q=="all_news")
    {
    $xml=("http://www.newsfarm.co.kr/rss/allArticle.xml");
    }
    elseif($q=="popularity")
    {
      $xml=("http://www.newsfarm.co.kr/rss/clickTop.xml");
    }

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);



//get elements from "<channel>"//
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

$channel_lastBuildDate = $channel->getElementsByTagName('lastBuildDate')
->item(0)->childNodes->item(0)->nodeValue;
//output elements from "<channel>"
echo("<p><a href='" . $channel_link
  . "'>" . $channel_title . "</a>");
echo("<br>");
echo"최근 업데이트 날짜";
echo($channel_lastBuildDate . "</p>");
echo "<hr>";
//get and output "<item>" elements //
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=10; $i++)
  {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_pubDate=$x->item($i)->getElementsByTagName('pubDate')
  ->item(0)->childNodes->item(0)->nodeValue;


  echo ("<p><h3><a href='" . $item_link
  . "'>" . $item_title . "</a></h3>");
  echo ("<br>");
  echo ($item_desc . "</p>");
  echo ($item_author . "</p>");
  echo ($item_pubDate . "</p>");
  echo "<hr>";
  }
?>
