<?php

namespace ThePLAN\IspringQuizPhp\Questions;

use DOMElement;
use ThePLAN\IspringQuizPhp\Utils\XmlUtils;

class TextCollection
{
    /**
     * @var array of string
     */
    private $items;

    public function TextCollection()
    {
        $this->clear();
    }

    /**
     * Add new item to collection
     *
     * @param $item - String
     * @return item index
     */
    public function addItem($item)
    {
        $this->items[] = trim($item);

        return count($this->items) - 1;
    }

    public function getItem($index)
    {
        return $this->items[$index];
    }

    public function getItemsCount()
    {
        return count($this->items);
    }

    public function toArray()
    {
        return $this->items;
    }

    public function initFromXmlNode(DOMElement $node, $itemTagName)
    {
        $this->clear();

        $itemsNodes = $node->getElementsByTagName($itemTagName);
        foreach ($itemsNodes as $itemNode) {
            $this->addItem(XmlUtils::getElementText($itemNode));
        }
    }

    /**
     * Create new TextCollection object, and init it from xml node
     *
     *
     * @return TextCollection
     */
    public static function fromXmlNode(DOMElement $node, $itemTagName)
    {
        $collection = new TextCollection();
        $collection->initFromXmlNode($node, $itemTagName);

        return $collection;
    }

    public function clear()
    {
        $this->items = [];
    }
}
