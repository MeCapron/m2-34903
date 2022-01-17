<?php

declare(strict_types=1);

namespace M2test\CustomerExt\Model;

class Response
{
    private ?AttributeTestingBlah $attributeTestingBlah = null;

    /**
     * @return AttributeTestingBlah;
     */
    public function getAttribute(): AttributeTestingBlah
    {
        return $this->attributeTestingBlah;
    }

    /**
     * @param AttributeTestingBlah $attributeTestingBlah
     *
     * @return $this
     */
    public function setAttribute(AttributeTestingBlah $attributeTestingBlah): Response
    {
        $this->attributeTestingBlah = $attributeTestingBlah;
        return $this;
    }
}
