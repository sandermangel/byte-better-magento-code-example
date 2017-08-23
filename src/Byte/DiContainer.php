<?php

namespace Byte;

class DiContainer
{
    private $dbl;
    private $outputClass;

    /**
     * DiContainer constructor.
     * @param \PDO $dbl
     * @param string $outputClass
     */
    public function __construct(\PDO $dbl, string $outputClass)
    {
        $this->dbl = $dbl;
        $this->outputClass = $outputClass;
    }

    /**
     * get SQL database connection
     * @return \PDO
     */
    public function getDbl(): \PDO
    {
        return $this->dbl;
    }

    /**
     * get user output class
     * @return string
     */
    public function getOutputClass(): string
    {
        return $this->outputClass;
    }
}