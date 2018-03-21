<?php
/**
*
*/
class XML extends DOMDocument
{

	function __construct($version="1.0",$encode="ISO-8859-1")
	{
		parent::__construct($version, $encode);
		$this->preserveWhiteSpace = true;
	}


	public function generate(array $array, \DOMElement &$parent = null)
	{
		if ($parent===null)
			$parent = &$this;
		foreach ($array as $key => $value) {
			if ($key=='@attributes') {
				foreach ($value as $attr => $val) {
					if ($val!==false)
						$parent->setAttribute($attr, $val);
				}
			} else if ($key=='@value') {
				$parent->nodeValue = $this->sanitize($value);
			} else {
				if (is_array($value)) {
					if (!empty($value)) {
						$keys = array_keys($value);
						if (!is_int($keys[0])) {
							$value = [$value];
						}
						foreach ($value as $value2) {
							$Node = new \DOMElement($key);
							$parent->appendChild($Node);
							$this->generate($value2, $Node);
						}
					}
				} else {
					if (is_object($value) and $value instanceof \DOMElement) {
						$Node = $this->importNode($value, true);
						$parent->appendChild($Node);
					} else {
						if ($value!==false) {
							$Node = new \DOMElement($key, $this->sanitize($value));
							$parent->appendChild($Node);
						}
					}
				}
			}
		}
		return $this;
	}


	private function sanitize($txt)
	{
        // si no se paso un texto o bien es un número no se hace nada
		if (!$txt or is_numeric($txt))
			return $txt;
        // convertir "predefined entities" de XML
		$txt = str_replace(
			['&amp;', '&#38;', '&lt;', '&#60;', '&gt;', '&#62', '&quot;', '&#34;', '&apos;', '&#39;'],
			['&', '&', '<', '<', '>', '>', '"', '"', '\'', '\''],
			$txt
			);
		$txt = str_replace(
			['&', '"', '\''],
			['&amp;', '&quot;', '&apos;'],
			$txt
			);
        // entregar texto sanitizado
		return $txt;
	}

	public function getFlattened($xpath = null)
	{
		if ($xpath) {
			$node = $this->xpath($xpath)->item(0);
			if (!$node)
				return false;
			$xml = $this->encode($node->C14N());
		} else {
			$xml = $this->C14N();
		}
		$xml = preg_replace("/\>\n\s+\</", '><', $xml);
		$xml = preg_replace("/\>\n\t+\</", '><', $xml);
		$xml = preg_replace("/\>\n+\</", '><', $xml);
		return trim($xml);
	}

	public function getFlattened2($xpath = null)
	{
		if ($xpath) {
			$node = $this->xpath($xpath)->item(0);
			if (!$node)
				return false;
			$xml = $this->encode($node->C14N());
		} else {
			$xml = $this->C14N();
		}
		$xml = preg_replace("/\>\n\s+\</", '><', $xml);
		$xml = preg_replace("/\>\n\t+\</", '><', $xml);
		$xml = preg_replace("/\>\n+\</", '><', $xml);
		$xml= str_replace("Aacute;", "A", $xml);
		$xml= str_replace("&amp;", "", $xml);
		$xml= str_replace("-", "", $xml);
		return trim($xml);
	}
	
	public function xpath($expression)
	{

		return (new \DOMXPath($this))->query($expression);
	}

	private function encode($string)
	{
		return mb_detect_encoding($string, ['UTF-8', 'ISO-8859-1']) != 'ISO-8859-1' ? utf8_decode($string) : $string;
	}


}
?>
