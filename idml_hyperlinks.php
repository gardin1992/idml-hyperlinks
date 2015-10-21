<?php

$data = file_get_contents("Story_u1ba.xml");

$catalogue = new SimpleXMLElement($data);

$destinationUniqueKeyCount = 1;
$HyperlinkPageItemSourceSelfCount = 1;
$hyperlinkcount = 1;
$namecount = 1;

$urlBase = ""; // URL base 

foreach ($catalogue->Story->ParagraphStyleRange as $para) {

	if (array_key_exists("Rectangle", $para->CharacterStyleRange)) {
		$imageID = $para->CharacterStyleRange[0]->Rectangle['Self'];
    
    // substr numbers change with different file links in catalogue
		$isbn = substr($para->CharacterStyleRange[0]->Rectangle->Image->Link['LinkResourceURI'],94,13);

		$name = $para->CharacterStyleRange[2]->Content;
		if (!empty($isbn)) {
			$url = $urlBase . $isbn;
			$hyperlinkURLDestination = "HyperlinkURLDestination/http%3a//" . $url;

			$destinationURL = "http://" . $url;

			$HyperlinkURLDestination_XML  = "<HyperlinkURLDestination Self=\"$hyperlinkURLDestination $namecount\" DestinationUniqueKey=\"$destinationUniqueKeyCount\" Name=\"$destinationURL $namecount\" DestinationURL=\"$destinationURL\" Hidden=\"false\"/>";
			
			$HyperlinkPageItemSourceSelf = "vv1a" . $HyperlinkPageItemSourceSelfCount;

			$HyperlinkPageItemSource_XML = "<HyperlinkPageItemSource Self=\"$HyperlinkPageItemSourceSelf\" Name=\"Hyperlink $hyperlinkcount\" SourcePageItem=\"$imageID\" Hidden=\"false\"/>";

			$HyperlinkPageItemSourceSelfCount++;

			$HyperlinkPageItemSourceSelf2 = "vv1a" . $HyperlinkPageItemSourceSelfCount;

			$Hyperlink_XML = 
			"<Hyperlink Self=\"$HyperlinkPageItemSourceSelf2\" Name=\"Hyperlinkk $hyperlinkcount\" Source=\"$HyperlinkPageItemSourceSelf\" Visible=\"false\" Highlight=\"None\" Width=\"Thin\" BorderStyle=\"Solid\" Hidden=\"false\" DestinationUniqueKey=\"$destinationUniqueKeyCount\"><Properties><BorderColor type=\"enumeration\">Black</BorderColor><Destination type=\"object\">$hyperlinkURLDestination $namecount</Destination></Properties></Hyperlink>";

			print($HyperlinkURLDestination_XML . "\n");
			print($HyperlinkPageItemSource_XML . "\n");
			print($Hyperlink_XML . "\n");

			$HyperlinkURLDestination_array[] = $HyperlinkURLDestination_XML;
			$HyperlinkPageItemSource_array[] = $HyperlinkPageItemSource_XML;
			$Hyperlink_array[] = $Hyperlink_XML;

			$destinationUniqueKeyCount++;
			$HyperlinkPageItemSourceSelfCount++;
			$hyperlinkcount++;
			$namecount++;
		}
	}
}


foreach ($HyperlinkURLDestination_array as $xml) {
	print($xml);
	print("\n");
}

$index = count($HyperlinkPageItemSource_array);

while($index) {
  print($HyperlinkPageItemSource_array[--$index] . "\n");
}


foreach ($Hyperlink_array as $xml) {
	print($xml);
	print("\n");
}
    
    

?>
