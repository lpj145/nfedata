<?php
namespace NfeData;

class NfeDocument
{
    public $xml;

    public $chave;

    public $versao;

    public $ide;

    public $emit;

    public $dest;

    public $prods = [];

    public $total;

    public $vol;

    public $pag;

    public $transp;

    public $infAdic;

    public function __construct(string $xmlString)
    {
        $xmlObject = simplexml_load_string($xmlString);

        if (!property_exists($xmlObject, 'infNFe')) {
            throw new \InvalidArgumentException('xmlString não é uma string xml válida!');
        }

        $this->xml = $xmlString;

        $xmlArray = json_decode(json_encode($xmlObject->infNFe), true);
        $this->chave = str_replace('NFe', '', (string)$xmlObject->infNFe->attributes()->Id);
        $this->versao = (string)$xmlObject->infNFe->attributes()->versao;

        $this
            ->setPropertyByXmlElement('ide', $xmlArray)
            ->setPropertyByXmlElement('emit', $xmlArray)
            ->setPropertyByXmlElement('dest', $xmlArray)
            ->setPropertyByXmlElement('det', $xmlArray)
            ->setPropertyByXmlElement('total', $xmlArray)
            ->setPropertyByXmlElement('transp', $xmlArray)
            ->setPropertyByXmlElement('pag', $xmlArray)
            ->setPropertyByXmlElement('infAdic', $xmlArray)
        ;
    }

    /**
     * Set var on this scope
     * @param string $propertyName
     * @param \SimpleXMLElement $xmlObject
     * @return $this
     */
    protected function setPropertyByXmlElement(string $propertyName, array $xmlArray)
    {
        if (isset($xmlArray[$propertyName])) {
            $this->{$propertyName} = new SpedData($xmlArray[$propertyName]);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChave()
    {
        return $this->chave;
    }

    /**
     * @return string
     */
    public function getVersao()
    {
        return $this->versao;
    }

    /**
     * @param $name
     * @return SpedData
     */
    public function get($name) : SpedData
    {
        return $this->{$name} ?? null;
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }
}
