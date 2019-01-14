<?php

require_once './app/models/XmlParser.php';

use PHPUnit\Framework\TestCase;

class XMLParserTest extends TestCase
{
	public function testXmlParseFunction()
	{
        $xml = "<messagerx>";
        $xml .= "<sourcemsisdn>447817814149</sourcemsisdn>" ;
        $xml .= "<destinationmsisdn>447817814149</destinationmsisdn>";
        $xml .= "<receivedtime>27/12/2014 02:19:28</receivedtime>";
        $xml .= "<bearer>SMS</bearer>";
        $xml .= "<messageref>0</messageref>";
        $xml .= "<message>";
        $xml .= "<group_id>ctec3110</groud_id>";
        $xml .= "<s1>0</s1>";
        $xml .= "<s2>1</s2>";
        $xml .= "<s3>1</s3>";
        $xml .= "<s4>0</s4>";
        $xml .= "<f>1</f>";
        $xml .= "<t>21</t>";
        $xml .= "<k>2</k>";
        $xml .= "</message>";
        $xml .= "</messagerx>";

		$parser = new XMLParser();
		$parser->parse($xml);
		$this->assertFalse(sizeof($parser->getParsedData()) == 0);
	}
}
