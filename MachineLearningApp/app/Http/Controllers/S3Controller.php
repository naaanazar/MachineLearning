<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class S3Controller extends Controller
{
    public $bucket = 'ml-datasets-test';
    public $newBucketName = 'ml-datasets-testing';

    public function predictionForm()
    {
        return view('prediction.prediction');
    }

    private function connectToS3()
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

    public function uploadFileToS3(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $storagePath = storage_path('/app/uploads');
        $file->move($storagePath, $fileName);

        $filepath = $storagePath . '/' . $fileName;
        $keyname = basename($filepath);
        $client = $this->connectToS3();

        try {
            $result = $client->putObject(array(
                'Bucket' => $this->bucket,
                'Key' => $keyname,
                'SourceFile' => $filepath,
                'ACL' => 'public-read'
            ));

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
        return redirect('list')->with('status', '<strong>Success!</strong> File successfully uploaded to S3');
    }

    public function deleteFileFromS3($filename)
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

    public function listFileFromS3()
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

    public function listOfBuckets()
    {
        $client = $this->connectToS3();

        try {
            $result = $client->listBuckets([
            ]);

            dd($result);
            //$results = $result['Contents'];
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }

        //return view('s3.list', compact('results'));
    }


    public function createBucket()
    {
        $client = $this->connectToS3();

        try {

            $client->createBucket([
                'ACL' => 'private',
                'Bucket' => $this->newBucketName . 11, // REQUIRED
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
        //return back();

    }


    public function deleteBucket($nameBucket)
    {
        $client = $this->connectToS3();

        try {
//dd($nameBacket);
            $client->deleteBucket([
                'Bucket' => $nameBucket, // REQUIRED
            ]);

        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }


    public function deleteAllObjectsFromBucket()
    {
        $client = $this->connectToS3();



        try {

            $results = $client->listObjects(array('Bucket' => $this->newBucketName . 11))->get('Contents');

            foreach($results as $key => $value) {

                $client->deleteObject(array(
                    'Bucket' => $this->newBucketName . 11,
                    'Key' => $value['Key'],
                ));
            }
        } catch (S3Exception $e) {
            echo $e->getMessage() . "\n";
        }



    }




}
