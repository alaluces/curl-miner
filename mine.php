#!/usr/bin/php -q
<?php 
/*
cURL Miner
Uses simple_html_dom.php and cURL via shell_exec()
Syntax: ./mine.php [Starting page] [Ending page] >> [Destination output]
Example: ./mine.php 0 20 >> leads.csv

20151030 - First
20151031 - Cleanup
         - Start and end values are accepted as argument

*/
require 'dom/simple_html_dom.php';

$start = $argv[1];
$end   = $argv[2];



for ($i = $start; $i < $end; $i++) {
	// Login to reference USA first to get the cUrl string and access keys
	// Copy the cUrl string using firebug and paste it below
	$str_html = shell_exec("curl -ss 'http://www.referenceusa.com.sdplproxy.sandiego.gov/UsConsumer/Result/Page' -H 'Accept: text/html, */*' -H 'Accept-Encoding: gzip, deflate' -H 'Accept-Language: en-US,en;q=0.5' -H 'Cache-Control: no-cache' -H 'Connection: keep-alive' -H 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8' -H 'Cookie: _ga=GA1.2.1515829896.1446170307; ezproxy=TqzZzmPomIRWi0q; .ASPXAUTH=926571B7E5DEEB6E79D94B9076BFEF4C2116006D4B0A83663C7FD2A0FD50821697CC7AC1376C302C1E493EF84DF1821D4E18EDCD121728B5FC494B23620F0F9808858A8CBC719DAAE8042474E29C016C03FC5D7ED2AEA37CBBC3F12E755815740935FBD25A2974E888F8D3A5D3D892C5309A5663C1FA0AF77FD74547F2BCC028B2C0FE3E6FF2DA984526738DCFCBF5DB8619224B4B776A48E7BE1DC61C2476922878892782D606882F748357F3DCBE2489219BAEC1B62F34F0EBB7027873EA79E68BF04AF3DCAC863BC23852A93D443F9F112E13274C63E05D6944D64863E88A9856D30022B2844AE247E4AA70945D7C7D245E3BDD027B69B21383FD7BD5760CAA379E8B1928E2A75F5D548B3B0F9DE42DB996D4295FE923999DE510621E96F0CCD45A49771F99943DCC45B5004CA35133DB44D88DDFDDB6FF9CACD2E39CBB58BEDC658C1B79C5DB9B6CD7147814B2CC27B0A4F8A77613D78552DA0D275B528C53757A6984FF3CFB8A7D713B2A1C43B41AB9224FF4444A5CAF5E0052745B473B3746B6A946B6D6F408F23FBB7437AF84CF308E6B803EC0664F9EB27F9937E06D810AF21F770590F4989FD81E5516B38A16E13ED58CD664CF0CB6AEF2A70DE717F3B38E7606C15CCAD3917A60D08B5A71ECF1BF3C287BCBD7292E64C2C233437001337E010A517A5D; BIGipServerrefusa_http=3209996480.20480.0000; TS0180d824=010cc37ea8fe9db52c2638f597e4d5d8080d4cdda3d6f9ccd9dd70c22282089e808afcc717d36b5be060f73748aa6cd260414f05e6445a66ab9f0c9504d5b0cbbb6e0118d34c23d0e195525088ea63b0e451ba48f1; ASP.NET_SessionId=1oosnzzp5wakz14khu5hett5; ai_user=86D2EBB6-3253-4D09-9C9D-088B1CA9E62F|2015-10-30T03:29:02.572Z; ai_session=766FE370-2D83-49B5-BAA5-D8CF4F97649B|1446175797775|1446176266181; __utma=126180366.1515829896.1446170307.1446175867.1446175867.1; __utmb=126180366.22.10.1446175867; __utmc=126180366; __utmz=126180366.1446175867.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); TS0180d824_77=4411_2c686ed03ffc36d3_rsb_0_rs_%2FUsConsumer%2FSearch%2FQuick%2F5f0d5bbce1d444e8b3fd01cdfbf20611_rs_2_rs_0; isUsBusHistoricalTab=false' -H 'Host: www.referenceusa.com.sdplproxy.sandiego.gov' -H 'Pragma: no-cache' -H 'Referer: http://www.referenceusa.com.sdplproxy.sandiego.gov/UsConsumer/Result/5f0d5bbce1d444e8b3fd01cdfbf20611' -H 'User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:41.0) Gecko/20100101 Firefox/41.0' -H 'X-Requested-With: XMLHttpRequest' --data 'requestKey=5f0d5bbce1d444e8b3fd01cdfbf20611&sort=&direction=Ascending&pageIndex=$i&optionalColumn='");
	$html = str_get_html($str_html);
	$table = $html->find('table', 0);
	foreach($table->find('tr') as $row) {
		foreach($row->find('td') as $cell) {
			echo $cell->plaintext . ',';
		}
	   echo "\n";
	}
}