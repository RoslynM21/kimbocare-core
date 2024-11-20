<?php

namespace Kimbocare\Core;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Service pour la gestion des fichiers, incluant l'upload, la validation
 * de taille maximale, et le traitement des images.
 */
class FileService
{
    public function save(UploadedFile $file, string $pathDirectory = 'uploads/', ?int $imageWidth = null, ?int $maxFileSize = null): array
    {
        // Utilisez $this->image à la place de la facade
        $extension = $file->getClientOriginalExtension();
        $hash = hash("sha256", $file->__toString());
        $filename = $hash . "." . $extension;
        $fullPath = rtrim($pathDirectory, '/') . '/' . $filename;

        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
        $resizedImage = null;

        if ($isImage && $imageWidth) {
            try {
                $resizedImage = Image::make($file)
                    ->resize($imageWidth, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($extension, 90);
            } catch (\Exception $e) {
                throw new \Exception("Erreur lors du traitement de l'image : " . $e->getMessage());
            }
        }

        if ($isImage && $resizedImage) {
            Storage::put($fullPath, $resizedImage->__toString());
        } else {
            $fullPath = Storage::putFileAs($pathDirectory, $file, $filename);
        }

        return [
            "path" => $fullPath,
            "extension" => $extension,
            "filename" => $filename,
        ];
    }


    /**
     * Vérifie si un fichier dépasse une taille maximale en Mo.
     *
     * @param \Illuminate\Http\UploadedFile $file Le fichier à vérifier.
     * @param float $maxSize La taille maximale en Mo.
     * @return bool True si le fichier dépasse la taille maximale, sinon false.
     */
    public static function isMaxFileSize($file, float $maxSize): bool
    {
        return self::getSizeInMb($file) > $maxSize;
    }

    /**
     * Vérifie si un utilisateur ou une IP a dépassé la limite quotidienne de taille d'upload.
     *
     * @param \Illuminate\Http\UploadedFile $file Le fichier à vérifier.
     * @param string $ip L'adresse IP de l'utilisateur.
     * @param mixed|null $user L'utilisateur connecté (optionnel).
     * @param int $dailyLimit Limite quotidienne en Mo (par défaut 200 Mo).
     * @return bool True si la limite est dépassée, sinon false.
     */
    public static function isMaxFileSizePerDay($file, string $ip, $user = null, int $dailyLimit = 200): bool
    {
        $size = self::getSizeInMb($file);
        $timeUntilMidnight = now()->endOfDay()->diffInSeconds(now());

        // Gestion par utilisateur
        if ($user) {
            $userFileSize = Cache::get($user->id . "_files_sizes_in_mb", 0) + $size;
            Cache::put($user->id . "_files_sizes_in_mb", $userFileSize, $timeUntilMidnight);

            if ($userFileSize > $dailyLimit) {
                return true;
            }
        }

        // Gestion par IP
        $ipFileSize = Cache::get($ip . "_files_sizes_in_mb", 0) + $size;
        Cache::put($ip . "_files_sizes_in_mb", $ipFileSize, $timeUntilMidnight);

        return $ipFileSize > $dailyLimit;
    }

    /**
     * Récupère la taille d'un fichier en Mo.
     *
     * @param \Illuminate\Http\UploadedFile $file Le fichier.
     * @return float La taille du fichier en Mo.
     */
    private static function getSizeInMb($file): float
    {
        return $file->getSize() / 1048576; // 1 Mo = 1048576 octets
    }
}
