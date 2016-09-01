<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class BucketController extends Controller
{
    public $bucket = 'ml-datasets-test';
    public $newBucketName = 'ml-datasets-testing';

    private function connect()
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAI5RJSS2CYUZ6STHQ',
                'secret' => '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'
            ]
        ]);

        return $s3;
    }

    public function listOfBuckets()
    {
        $client = $this->connect();

        try {
            $result = $client->listBuckets([
            ]);
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return view('bucket.listBucket', ['results' => $result['Buckets']]);
    }


    public function createBucket(Request $request)
    {
        $client = $this->connect();

        try {

            $client->createBucket([
                'ACL' => 'public-read-write',
                'Bucket' => $request->nameBucket,
                'CreateBucketConfiguration' => [
                    'LocationConstraint' => 'us-east-1',
                ],
//                'GrantFullControl' => '1',
//                'GrantRead' => 'Allow',
//                'GrantReadACP' => 'Allow',
//                'GrantWrite' => 'Allow',
//                'GrantWriteACP' => 'Allow',
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return back();
    }


    public function deleteBucket($nameBucket)
    {
        $client = $this->connect();

        try {
            $client->deleteBucket([
                'Bucket' => $nameBucket,
            ]);

            return back();
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }


    public function deleteAllObjectsFromBucket($nameBucket)
    {
        $client = $this->connect();


        try {
            $results = $client->listObjects(array('Bucket' => $nameBucket))->get('Contents');

            foreach ($results as $key => $value) {

                $client->deleteObject(array(
                    'Bucket' => $nameBucket,
                    'Key' => $value['Key'],
                ));
            }
            return back();
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }


    }


    public function index()
    {
        return view('bucket.listBucket');
    }


}
