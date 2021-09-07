<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Feed extends CI_Controller {
    public function index(){
        header('Content-Type: text/xml');
        
        echo '<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" version="2.0">';
        echo '<channel>
                <title>Kupas Tuntas</title>
                <atom:link href="'.current_url().'" rel="self" type="application/rss+xml"/>
                <link>'.base_url().'</link>
                <description>Contoh</description>
                <lastBuildDate>'.date('D, j M Y H:i:s +0700').'</lastBuildDate>
                <language>id-ID</language>
                <sy:updatePeriod>hourly</sy:updatePeriod>
                <sy:updateFrequency>1</sy:updateFrequency>';
        
        $query_last_news = $this->db->query("Select posts.*,administrators.fullname from posts inner join administrators on administrators.administrator_id=posts.administrator_id where posts.date_publish<=now() and posts.date_publish is not null order by posts.date_publish desc limit 20");
        if($query_last_news->num_rows()){
            $last_news = $query_last_news->result_array();
            foreach($last_news as $item){
                $pubdate = explode(' ',$item['date_publish']);
                $pubdate__ = DateTime::createFromFormat("Y-m-d H:i:s",$item['date_publish']);
                ?>
                <item>
                    <title><?=$item['title']?></title>
                    <link><?=base_url(str_replace('-','/',$pubdate[0]).'/'.$item['slug'])?></link>
                    <pubDate><?=$pubdate__->format('D, j M Y H:i:s +0700')?></pubDate>
                    <dc:creator>
                    <![CDATA[ <?=$item['fullname']?> ]]>
                    </dc:creator>
                    <category>
                    <![CDATA[ <?=ucwords($item['module'])?> ]]>
                    </category>
                    <description>
                    <![CDATA[ <?=$item['synopsis']?> ]]>
                    </description>
                    <content:encoded>
                    <![CDATA[ <?=$item['content']?> ]]>
                    </content:encoded>
                    
                </item>
                <?php
            }
            
        }
        echo '</channel>';
        echo '</rss>';
        /*
        $dom = new DOMDocument();
		$dom->encoding = 'utf-8';
		$dom->xmlVersion = '1.0';
		$dom->formatOutput = true;
		$root = $dom->createElement('Movies');
		$movie_node = $dom->createElement('movie');
		$attr_movie_id = new DOMAttr('movie_id', '5467');
		$movie_node->setAttributeNode($attr_movie_id);
	    $child_node_title = $dom->createElement('Title', 'The Campaign');
		$movie_node->appendChild($child_node_title);
		$child_node_year = $dom->createElement('Year', 2012);
		$movie_node->appendChild($child_node_year);
	    $child_node_genre = $dom->createElement('Genre', 'The Campaign');
		$movie_node->appendChild($child_node_genre);
		$child_node_ratings = $dom->createElement('Ratings', 6.2);
		$movie_node->appendChild($child_node_ratings);
		$root->appendChild($movie_node);
		$dom->appendChild($root);
		@header('Content-Type: text/xml');
		echo $dom->saveXML();
		*/
    }
}