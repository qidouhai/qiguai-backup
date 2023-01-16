<?


//rss判断
function analyrss($isrsslink){
$isrsslink =file_get_contents($isrsslink);
$atom="http://www.w3.org/2005/Atom";

$rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns";

$rss="http://purl.org/dc/elements/1.1/";

$isatom=strstr($isrsslink,$atom);

$isrdf=strstr($isrsslink,$rdf);

$isrss=strstr($isrsslink,$rss);

$isrss2=strstr($isrsslink,$rss2);

if($isatom){return 1;}elseif($isrdf){return 2;}elseif($isrss){return 3;}elseif($isrss){return 4;}else{return 5;}

}





