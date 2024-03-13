<?php

class Parse
{
    public function xmlToArray($file)
    {

        $xml = simplexml_load_file($file['tmp_name']);

        if ($xml === false) {
            return [];
        }

        return $this->xmlToArrayRecursive($xml);
    }

    private function xmlToArrayRecursive(SimpleXMLElement $xml)
    {
        $result = [];

        foreach ($xml->children() as $child) {
            if ($child->children()->count() > 0) {
                $result[$child->getName()][] = $this->xmlToArrayRecursive($child);
            } else {
                $result[$child->getName()] = (string) $child;
            }
        }

        return $result;
    }

}