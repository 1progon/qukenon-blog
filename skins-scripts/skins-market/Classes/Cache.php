<?php


namespace App\Classes;


defined('ABS_PATH') or die('У Вас нет доступа');


class Cache
{

    const FORMAT_JSON = 'json';
    const FORMAT_SERIALIZE = 'ser';

    private array $keys;

    private int $validTime = 6 * 60 * 60; // Optimal Cache 6 hours
    private string $fileFormat = self::FORMAT_JSON;

    private string $cacheFolder = ABS_PATH . 'Resources/Cache/';

    private array $filePath;

    public function __construct(string $key = null)
    {
        if ($key) {
            $this->init($key);
        }
    }


    public function getCache(string $key): ?array
    {
        $this->init($key);

        if (!$this->isValidCache($key)) {
            $this->removeKey($key);
            return null;
        }

        return $this->getFromFile($key);
    }


    public function setCache(string $key, array $data, int $seconds = null): bool
    {
        $this->init($key)
            ->saveToFile($key, $data, $seconds);

        return $this->isExistFile($key) && $this->isValidCache($key);
    }

    /**
     * @param string $format
     * @param array|string $data
     * @param bool $encode
     * @return array|string|null
     */
    private function encodeDecode(string $format, $data, bool $encode = true)
    {
        switch ($format) {
            case self::FORMAT_JSON:
                if ($encode) {
                    $data = json_encode($data);
                } else {
                    $data = json_decode($data, true);
                }
                if ($data) {
                    return $data;
                }
                break;
            case self::FORMAT_SERIALIZE:
                if ($encode) {
                    $data = serialize($data);
                } else {
                    $data = unserialize($data);
                }
                if ($data) {
                    return $data;
                }
                break;
        }
        return null;
    }


    private function saveToFile(string $key, array $data, int $seconds = null): bool
    {
        $data = $this->encodeDecode($this->keys[$key], $data);

        if (!$data) {
            return false;
        }

        $isSaved = file_put_contents($this->filePath[$key], $data);

        if (!$isSaved) {
            return false;
        }

        if (!$seconds) {
            $seconds = $this->validTime;
        }

        return touch($this->filePath[$key], time() + $seconds);
    }

    public function getFromFile(string $key): ?array
    {
        $data = file_get_contents($this->filePath[$key]);

        if ($data) {
            $decodedData = $this->encodeDecode($this->keys[$key], $data, false);

            if ($decodedData) {
                return $decodedData;
            }
        }

        return null;
    }


    private function isExistFile(string $key): bool
    {
        return file_exists($this->filePath[$key]);
    }

    private function isValidCache(string $key): bool
    {
        if (!$this->isExistFile($key)) {
            return false;
        }
        return time() <= filemtime($this->filePath[$key]);
    }


    /**
     * @param string $fileFormat FORMAT_...const for help
     * @return Cache
     */
    public function setFileFormat(string $fileFormat): Cache
    {
        $this->fileFormat = $fileFormat;
        return $this;
    }


    /**
     * @param int $seconds Seconds Cache valid
     * @return Cache
     */
    public function setValidTime(int $seconds): Cache
    {
        $this->validTime = $seconds;
        return $this;
    }

    public function hasKey(string $key): bool
    {
        if (isset($this->keys[$key]) && isset($this->filePath[$key])) {
            return true;
        }
        return false;
    }

    /**
     * @param string $key
     * @return Cache
     */
    public function init(string $key): Cache
    {
        if (!$this->hasKey($key)) {
            $this->keys[$key] = $this->fileFormat;
            $this->filePath[$key] = $this->cacheFolder . $key . '.' . $this->fileFormat;
        }
        return $this;
    }

    public function removeKey(string $key): bool
    {
        if ($this->isExistFile($key)) {
            unlink($this->filePath[$key]);
        }
        unset($this->keys[$key], $this->filePath[$key]);
        return !$this->hasKey($key);
    }


}
