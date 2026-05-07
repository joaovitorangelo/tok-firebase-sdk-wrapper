<?php

namespace Tok\Firebase;

use Kreait\Firebase\Contract\Storage as FirebaseStorage;

class Storage
{
    private FirebaseStorage $storage;

    public function __construct(Client $client)
    {
        $this->storage = $client
            ->factory()
            ->createStorage();
    }

    /**
     * Upload de arquivo
     */
    public function upload(string $bucketPath, string $localFile): string
    {
        $bucket = $this->storage->getBucket();

        $object = $bucket->upload(
            fopen($localFile, 'r'),
            [
                'name' => $bucketPath
            ]
        );

        return $object->name();
    }

    /**
     * URL pública temporária
     */
    public function url(string $file, int $minutes = 60): string
    {
        $bucket = $this->storage->getBucket();

        $object = $bucket->object($file);

        return $object->signedUrl(
            new \DateTime("+{$minutes} minutes")
        );
    }

    /**
     * Remove arquivo
     */
    public function delete(string $file): void
    {
        $bucket = $this->storage->getBucket();

        $bucket->object($file)->delete();
    }
}