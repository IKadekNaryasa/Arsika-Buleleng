<?php

namespace App\Helpers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PdfHelper
{
    /**
     * Convert PDF to PDF 1.4 using Ghostscript.
     *
     * @param string $inputPath  Path ke PDF input
     * @param string $outputPath Path PDF hasil konversi
     * @param string|null $gsBinary Path Ghostscript (default null → pakai 'gs' di Linux/Mac atau 'gswin64c.exe' di Windows)
     * @param int $timeout Timeout in seconds
     * @return bool
     * @throws \RuntimeException
     */
    public static function convertToPdf14(string $inputPath, string $outputPath, ?string $gsBinary = null, int $timeout = 60): bool
    {
        if (!file_exists($inputPath)) {
            throw new \RuntimeException("Input file tidak ditemukan: {$inputPath}");
        }

        if (!$gsBinary) {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $gsBinary = 'C:\Program Files\gs\gs10.06.0\bin\gswin64c.exe';
            } else {
                $gsBinary = 'gs';
            }
        }

        $process = new Process([
            $gsBinary,
            '-sDEVICE=pdfwrite',
            '-dCompatibilityLevel=1.4',
            '-dNOPAUSE',
            '-dQUIET',
            '-dBATCH',
            "-sOutputFile={$outputPath}",
            $inputPath,
        ]);

        $process->setTimeout($timeout);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return file_exists($outputPath) && filesize($outputPath) > 0;
    }
}
