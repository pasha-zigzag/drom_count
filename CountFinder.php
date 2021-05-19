<?php


class CountFinder
{
    private string $countFileName = 'count';
    private string $directory;
    private string $separator;
    private int $countSum = 0;

    public const SPACE_SEPARATOR = ' ';
    public const NEW_LINE_SEPARATOR = '\r\n';

    public function __construct(string $directory, string $separator)
    {
        $this->directory = $directory;
        $this->separator = $separator;
    }

    /**
     * @throws Exception
     */
    function calculateCountSum() : void
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->directory));

        foreach ($iterator as $path) {
            if(is_file($path->getPathName()) && $path->getFileName() === $this->countFileName) {
                $countData = file_get_contents($path->getPathName());

                if($this->separator === self::NEW_LINE_SEPARATOR) {
                    $countNumbers = preg_split('/'.$this->separator.'/', $countData);
                } else {
                    $countNumbers = explode($this->separator, $countData);
                }

                if(is_array($countNumbers)) {
                    foreach ($countNumbers as $number) {
                        $this->countSum += intval($number);
                    }
                } else {
                    throw new Exception('Не удалось вычислить сумму');
                }
            }
        }
    }

    /**
     * @return int
     */
    public function getCountSum() : int
    {
        return $this->countSum;
    }
}