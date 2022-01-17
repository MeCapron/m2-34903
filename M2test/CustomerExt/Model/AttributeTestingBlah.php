<?php

declare(strict_types=1);

namespace M2test\CustomerExt\Model;

class AttributeTestingBlah
{
    private string $dataTt;

    /**
     * @return string
     */
    public function getDataTt(): string
    {
        return $this->dataTt;
    }

    /**
     * @param string $dataTt
     *
     * @return $this
     */
    public function setDataTt(string $dataTt): self
    {
        $this->dataTt = $dataTt;
        return $this;
    }
}
