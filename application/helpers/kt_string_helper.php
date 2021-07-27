<?php 
if(!function_exists('alpnum')){
    function alpnum($string = ''){
        return preg_replace( '/[^a-z0-9 ]/i', '', $string);
        unset($string);
    }   
}
if(!function_exists('slug')){
    function slug($string = ''){
		$first	= trim(str_replace(array('"',"'"),'',$string)); unset($string);
		$second = preg_replace('/[^a-zA-Z0-9\s\-]/mi','',urldecode($first)); unset($first);
		$third 	= preg_replace('!\s+!','-',$second); unset($second);
		$result = preg_replace('!-+!','-',$third); unset($third);
		return strtolower($result); unset($result);
    }   
}
if(!function_exists('date_indonesia')) {
    function date_indonesia($date, $format = 'Y-m-d'){

        $en = array('January','February','March','May','June','July','August','October','December','Aug','Oct','Dec','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sun','Mon','Tue','Thu','Wed','Fri','Sat');

        $id = array('Januari','Februari','Maret','Mei','Juni','Juli','Agustus','Oktober','Desember','Agu','Okt','Dec','Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Min','Sen','Sel','Rab','Kam','Jum','Sab');

        return str_replace($en,$id, date($format,strtotime($date)));

    }
}
if(!function_exists('kt_synopsis')) {
    function kt_synopsis($text,$length = 255, $nl2br = FALSE){
        $first = ($nl2br == TRUE ) ? strip_tags(nl2br(trim($text)),"<br>") : strip_tags(trim($text));
        $second = substr($first,0,$length);
        $result = strlen($text) > $length ? substr($first,0,strrpos($second," ")) : $second;
        return $result; unset($text,$first,$second,$result);
    }
}