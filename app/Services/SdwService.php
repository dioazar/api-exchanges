<?php


namespace App\Services;


use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Prewk\XmlStringStreamer;

class SdwService
{
    private $client;
    private $file;

    const BASE_URL = 'https://sdw-wsrest.ecb.europa.eu/service/data/';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getPeriod(Carbon $start, Carbon $end): Collection
    {
        $response = $this->client->request('GET', self::BASE_URL.'EXR/D...SP00.A', [
            'query' => [
                'startPeriod' => $start->format('Y-m-d'),
                'endPeriod' => $end->format('Y-m-d'),
                'detail' => 'dataonly'
            ]
        ]);

        return collect($this->xmlToArray($response->getBody()->getContents()));
    }

    private function xmlToArray(string $xmlstring): array
    {
        $this->saveXml($xmlstring);
        $streamer = XmlStringStreamer::createUniqueNodeParser($this->file, array("uniqueNode" => "generic:Series"));

        $arr = [];

        while ($node = $streamer->getNode()) {
            try {
                $node = str_replace('generic:', '', $node);
                $simpleXmlNode = simplexml_load_string($node);
                $json = json_encode($simpleXmlNode);
                $arr[] = json_decode($json,TRUE);
            } catch (\Throwable $exception) {
                Storage::delete($this->file);
            }
        }

        Storage::delete($this->file);

        return $arr;
    }

    private function saveXml(string $xml)
    {
        $filename = 'xml/'.time().'.xml';
        Storage::disk('local')->put($filename, $xml);

        $this->file = Storage::disk('local')->path($filename);
    }
}
