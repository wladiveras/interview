<?php

class Parse
{
    public function xmlToArray($data)
    {
        $xml = simplexml_load_string($data);

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