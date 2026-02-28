<?php

namespace App\Models;

/**
 * Class VideoStream
 *
 * Handles partial video streaming with HTTP range support.
 */
class VideoStream
{
    /** @var string Path to the video file */
    private $path = "";

    /** @var resource Stream handle */
    private $stream = "";

    /** @var int Number of bytes to read per chunk */
    private $buffer = 5000000;

    /** @var int Start byte for streaming */
    private $start = -1;

    /** @var int End byte for streaming */
    private $end = -1;

    /** @var int Total file size */
    private $size = 0;

    /**
     * Constructor
     *
     * @param string $filePath Path to the video file
     */
    public function __construct($filePath)
    {
        $this->path = $filePath;
    }

    /**
     * Open the file stream
     */
    private function open()
    {
        if (!($this->stream = fopen($this->path, 'rb'))) {
            die('Could not open stream for reading');
        }
    }

    /**
     * Set proper headers for video streaming
     */
    private function setHeader()
    {
        session_write_close();
        ob_get_clean();

        header("Content-Type: video/mp4");
        header("Cache-Control: max-age=2592000, public");
        header("Expires: " . gmdate('D, d M Y H:i:s', time() + 2592000) . ' GMT');
        header("Last-Modified: " . gmdate('D, d M Y H:i:s', @filemtime($this->path)) . ' GMT');

        $this->start = 0;
        $this->size  = filesize($this->path);
        $this->end   = $this->size - 1;

        header("Accept-Ranges: 0-" . $this->end);

        if (isset($_SERVER['HTTP_RANGE'])) {
            $c_start = $this->start;
            $c_end = $this->end;

            list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);

            if (strpos($range, ',') !== false) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $this->start-$this->end/$this->size");
                exit;
            }

            if ($range == '-') {
                $c_start = $this->size - substr($range, 1);
            } else {
                $range = explode('-', $range);
                $c_start = $range[0];
                $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $c_end;
            }

            $c_end = ($c_end > $this->end) ? $this->end : $c_end;

            if ($c_start > $c_end || $c_start > $this->size - 1 || $c_end >= $this->size) {
                header('HTTP/1.1 416 Requested Range Not Satisfiable');
                header("Content-Range: bytes $this->start-$this->end/$this->size");
                exit;
            }

            $this->start = $c_start;
            $this->end = $c_end;
            $length = $this->end - $this->start + 1;

            fseek($this->stream, $this->start);

            header('HTTP/1.1 206 Partial Content');
            header("Content-Length: " . $length);
            header("Content-Range: bytes $this->start-$this->end/" . $this->size);
        } else {
            header("Content-Length: " . $this->size);
        }
    }

    /**
     * Close the current stream
     */
    private function close()
    {
        fclose($this->stream);
        exit;
    }

    /**
     * Stream the file in chunks
     */
    private function stream()
    {
        $i = $this->start;
        set_time_limit(0);

        while (!feof($this->stream) && $i <= $this->end) {
            $bytesToRead = $this->buffer;
            if (($i + $bytesToRead) > $this->end) {
                $bytesToRead = $this->end - $i + 1;
            }

            $data = fread($this->stream, $bytesToRead);
            echo $data;
            flush();
            $i += $bytesToRead;
        }
    }

    /**
     * Start streaming video content
     */
    public function start()
    {
        $this->open();
        $this->setHeader();
        $this->stream();
        $this->close();
    }
}
