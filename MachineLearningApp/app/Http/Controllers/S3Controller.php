<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3Controller extends Controller
{
    public $bucket = 'ml-datasets-test';
    
    public function predictionForm()
    {
        return view('prediction');
    }

    public function displayList()
    {
        return view('list');
    }

    private function connectToS3()
    {
        $s3 = new S3Client([
            'version'     => 'latest',
            'region'      => 'us-east-1',
            'credentials' => [
                'key'    => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
            ]
        ]);

        return $s3;
    }


    public function uploadFileToS3 ($filepath)
    {
        $keyname = basename($filepath);
        $client = $this->connectToS3();

        try {
            $result = $client->putObject(array(
                'Bucket' => $this->bucket,
                'Key'    => $keyname,
                'SourceFile'   => $filepath,
                'ACL'    => 'public-read'
            ));

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return $result['ObjectURL'];
    }


    public function deleteFileFromS3 ($filename)
    {
        $client = $this->connectToS3();

        try {
            $client->deleteObject([
                'Bucket' => $this->bucket,
                'Key' => $filename,
                'RequestPayer' => 'requester'
            ]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return back();
    }


    public function listFileFromS3 ()
    {

        $client = $this->connectToS3();

        try {
            $result = $client->listObjects([
                'Bucket' => $this->bucket,
                'Delimiter' => '|'
            ]);

            $results = $result['Contents'];

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        return view('s3.list', compact('results'));
    }
}
