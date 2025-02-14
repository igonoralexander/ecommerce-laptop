<?php

namespace App\Services;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Config;
use League\Flysystem\Adapter\AbstractAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\BlobType;
use MicrosoftAzure\Storage\Blob\Models\GetBlobOptions;

class AzureBlobStorage extends AbstractAdapter
{
    protected $client;
    protected $container;

    public function __construct($config)
    {
        $this->client = BlobRestProxy::createBlobService(
            "DefaultEndpointsProtocol=https;AccountName={$config['name']};AccountKey={$config['key']};BlobEndpoint={$config['url']};"
        );

        $this->container = $config['container'];
    }

    public function write($path, $contents, Config $config)
    {
        $this->client->createBlockBlob($this->container, $path, $contents);
        return ['path' => $path, 'contents' => $contents];
    }

    public function writeStream($path, $resource, Config $config)
    {
        $stream = stream_get_contents($resource);
        return $this->write($path, $stream, $config);
    }

    public function update($path, $contents, Config $config)
    {
        return $this->write($path, $contents, $config);
    }

    public function updateStream($path, $resource, Config $config)
    {
        return $this->writeStream($path, $resource, $config);
    }

    public function rename($path, $newpath)
    {
        $this->copy($path, $newpath);
        $this->delete($path);
    }

    public function copy($path, $newpath)
    {
        $sourceBlobUrl = "{$this->client->getPsrPrimaryUri()}/{$this->container}/{$path}";
        $this->client->copyBlob($this->container, $newpath, $this->container, $path);
    }

    public function delete($path)
    {
        $this->client->deleteBlob($this->container, $path);
    }

    public function deleteDir($dirname)
    {
        $blobs = $this->listContents($dirname, true);
        foreach ($blobs as $blob) {
            $this->delete($blob['path']);
        }
    }

    public function createDir($dirname, Config $config)
    {
        return ['path' => $dirname, 'type' => 'dir'];
    }

    public function setVisibility($path, $visibility)
    {
        // Azure blobs do not support native visibility settings
        return ['visibility' => $visibility];
    }

    public function has($path)
    {
        try {
            $this->client->getBlobMetadata($this->container, $path);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function read($path)
    {
        $blob = $this->client->getBlob($this->container, $path);
        return stream_get_contents($blob->getContentStream());
    }

    public function readStream($path)
    {
        $blob = $this->client->getBlob($this->container, $path);
        return $blob->getContentStream();
    }

    public function listContents($directory = '', $recursive = false)
    {
        $listOptions = new ListBlobsOptions();
        $listOptions->setPrefix($directory);

        $blobs = $this->client->listBlobs($this->container, $listOptions)->getBlobs();
        $contents = [];

        foreach ($blobs as $blob) {
            $lastModified = $blob->getProperties()->getLastModified();
            $contents[] = [
                'path' => $blob->getName(),
                'timestamp' => strtotime($lastModified->format('Y-m-d H:i:s')) // Convert DateTime to string
            ];
        }        

        return $contents;
    }

    public function getMetadata($path)
    {
        $blob = $this->client->getBlobMetadata($this->container, $path);
        return $blob->getMetadata();
    }

    public function getSize($path)
    {
        $blob = $this->client->getBlobProperties($this->container, $path);
        return ['size' => $blob->getProperties()->getContentLength()];
    }

    public function getMimetype($path)
    {
        $blob = $this->client->getBlobProperties($this->container, $path);
        return ['mimetype' => $blob->getProperties()->getContentType()];
    }

    public function getTimestamp($path) 
    {
        $blob = $this->client->getBlobProperties($this->container, $path);
        $lastModified = $blob->getProperties()->getLastModified();
        
        // Convert DateTime to string using format and then use strtotime
        return ['timestamp' => strtotime($lastModified->format('Y-m-d H:i:s'))];
    }
    

    public function getVisibility($path)
    {
        return ['visibility' => AdapterInterface::VISIBILITY_PUBLIC];
    }

    public function getUrl($path)
    {
        return "{$this->client->getPsrPrimaryUri()}/{$this->container}/{$path}";
    }
}
